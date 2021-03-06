<?php

class DocumentController extends Zend_Controller_Action
{

    protected $_user = null;

    public function init()
    {
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $this->_user = TM_User_User::getInstanceById($storage_data->id);

        $this->_helper->AjaxContext()->addActionContext('view', 'html')->initContext('html');
    }

    public function indexAction()
    {
        $parentId = $this->getRequest()->getParam('parent', 0);
        $this->view->assign('documentList', TM_Document_Document::getAllInstance($this->_user, $parentId));

        if ($parentId != 0) {
            $curDocument = TM_Document_Document::getInstanceById($parentId);

            $this->view->assign('document', $curDocument);
            $this->view->assign('breadcrumbs', $curDocument->getPathToDocument());
        }

        $this->view->assign('parentId', $parentId);
    }

    public function viewattributetypeAction()
    {
        $oMapper = new TM_Document_AttributeTypeMapper();
        $this->view->assign('attributeTypeList', $oMapper->getAllInstance());
    }

    public function viewhashAction()
    {
        $this->view->assign('attributeHashList', TM_Document_Hash::getAllInstance());
    }

    public function addAction()
    {
        $oDocument = new TM_Document_Document();
        $oDocument->setUser($this->_user);
        $oDocument->setDateCreate(date('d.m.Y H:i:s'));
        $oDocument->setIsFolder(false);

        if ($this->getRequest()->getParam('parent', 0) != 0) {
            $oDocument->setParent(TM_Document_Document::getInstanceById($this->getRequest()->getParam('parent', 0)));
        }

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDocument->setTitle($data['title']);
            $oDocument->setDateCreate($data['date_create']);

            if (!empty($data['parentDocument'])) {
                $oDocument->setParent(TM_Document_Document::getInstanceById($data['parentDocument']));
            }

            try {
                $oDocument->insertToDb();

                if (!empty($data['parentDocument'])) {
                    $documentAcl = TM_Acl_DocumentAcl::getAllInstance($oDocument->getParent());
                    if (!empty($documentAcl)) {
                        foreach ($documentAcl as $acl) {
                            $tempAcl = new TM_Acl_DocumentAcl($oDocument);
                            $tempAcl->setUser($acl->getUser());
                            $tempAcl->setIsRead($acl->getIsRead());
                            $tempAcl->setIsWrite($acl->getIsWrite());
                            $tempAcl->saveToDb();
                        }
                    }
                }

                TM_Activity_ActivityLogger::logMessage($this->_user, 'Документы', 'Добавлен документ ' . $oDocument->getTitle(), $oDocument);

                $this->redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Document_Document::getAllInstance($this->_user, -1, 1));
        $this->view->assign('document', $oDocument);
    }

    public function editAction()
    {
        $oDocument = TM_Document_Document::getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDocument->setTitle($data['title']);
            $oDocument->setDateCreate($data['date_create']);
            $oDocument->setIsFolder(false);

            if (!empty($data['parentDocument'])) {
                $oDocument->setParent(TM_Document_Document::getInstanceById($data['parentDocument']));
            }

            foreach ($data['attribute'] as $key => $value) {
                $oDocument->setAttribute($key, $value);
            }

            try {
                $oDocument->updateToDb();
                TM_Activity_ActivityLogger::logMessage($this->_user, 'Документы', 'Изменен документ ' . $oDocument->getTitle(), $oDocument);
                $this->redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Document_Document::getAllInstance($this->_user, -1, 1));
        $this->view->assign('attributeHashList', TM_Document_Hash::getAllInstance($oDocument));
        $this->view->assign('taskList', TM_Task_Task::getTaskByDocument($this->_user, $oDocument));
        $this->view->assign('document', $oDocument);
    }

    public function deleteAction()
    {
        $oDocument = TM_Document_Document::getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oDocument->deleteFromDB();
            TM_Activity_ActivityLogger::logMessage($this->_user, 'Документы', 'Удален документ ' . $oDocument->getTitle(), $oDocument);
            $this->redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());

        }
    }

    public function viewAction()
    {
        $oDocument = TM_Document_Document::getInstanceById($this->getRequest()->getParam('id'));
        $this->view->assign('attributeHashList', TM_Document_Hash::getAllInstance($oDocument));
        $this->view->assign('taskList', TM_Task_Task::getTaskByDocument($this->_user, $oDocument));
        $this->view->assign('document', $oDocument);
    }

    public function showaclAction()
    {
        $oDocument = TM_Document_Document::getInstanceById($this->getRequest()->getParam('idDocument'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            try {
                foreach ($data as $idUser => $values) {

                    $documentAcl = new TM_Acl_DocumentAcl($oDocument);

                    $documentAcl->setUser(TM_User_User::getInstanceById($idUser));
                    $documentAcl->setIsRead($values['is_read']);
                    $documentAcl->setIsWrite($values['is_write']);
                    $documentAcl->saveToDb();
                }

                $this->redirect('/document/showAcl/parent/' . $this->getRequest()->getParam('parent', 0) . '/idDocument/' . $this->getRequest()->getParam('idDocument'));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }
        }

        $this->view->assign('documentAcl', TM_Acl_DocumentAcl::getAllInstance($oDocument));
        $this->view->assign('userList', TM_User_User::getAllInstance());
        $this->view->assign('document', $oDocument);
    }

    public function addfolderAction()
    {
        $oDocument = new TM_Document_Document();
        $oDocument->setUser($this->_user);
        $oDocument->setDateCreate(date('d.m.Y H:i:s'));
        $oDocument->setIsFolder(true);

        if ($this->getRequest()->getParam('parent', 0) != 0) {
            $oDocument->setParent(TM_Document_Document::getInstanceById($this->getRequest()->getParam('parent', 0)));
        }

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDocument->setTitle($data['title']);
            $oDocument->setDateCreate($data['date_create']);


            if (!empty($data['parentDocument'])) {
                $oDocument->setParent(TM_Document_Document::getInstanceById($data['parentDocument']));
            }

            try {
                $oDocument->insertToDb();

                if (!empty($data['parentDocument'])) {
                    $documentAcl = TM_Acl_DocumentAcl::getAllInstance($oDocument->getParent());
                    if (!empty($documentAcl)) {
                        foreach ($documentAcl as $acl) {
                            $tempAcl = new TM_Acl_DocumentAcl($oDocument);
                            $tempAcl->setUser($acl->getUser());
                            $tempAcl->setIsRead($acl->getIsRead());
                            $tempAcl->setIsWrite($acl->getIsWrite());
                            $tempAcl->saveToDb();
                        }
                    }
                }
                TM_Activity_ActivityLogger::logMessage($this->_user, 'Документы', 'Добавлена папка ' . $oDocument->getTitle(), $oDocument);
                $this->redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Document_Document::getAllInstance($this->_user, -1));
        $this->view->assign('document', $oDocument);
    }

    public function editfolderAction()
    {
        $oDocument = TM_Document_Document::getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDocument->setTitle($data['title']);
            $oDocument->setDateCreate($data['date_create']);

            if (!empty($data['parentDocument'])) {
                $oDocument->setParent(TM_Document_Document::getInstanceById($data['parentDocument']));
            }

            foreach ($data['attribute'] as $key => $value) {
                $oDocument->setAttribute($key, $value);
            }

            try {
                $oDocument->updateToDb();
                TM_Activity_ActivityLogger::logMessage($this->_user, 'Документы', 'Изменена папка ' . $oDocument->getTitle(), $oDocument);
                $this->redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Document_Document::getAllInstance($this->_user), -1);
        $this->view->assign('attributeHashList', TM_Document_Hash::getAllInstance());
        $this->view->assign('document', $oDocument);
    }

    public function deletefolderAction()
    {
        $oDocument = TM_Document_Document::getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oDocument->deleteFromDB();
            TM_Activity_ActivityLogger::logMessage($this->_user, 'Документы', 'Удалена папка ' . $oDocument->getTitle(), $oDocument);
            $this->redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        // action body
    }


    public function addattributetypeAction()
    {
        $oMapper = new TM_Document_AttributeTypeMapper();
        $oType = new TM_Attribute_AttributeType();

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oMapper->insertToDb($oType);
                $this->redirect('/document/viewAttributeType');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function editattributetypeAction()
    {
        $oMapper = new TM_Document_AttributeTypeMapper();
        $oType = $oMapper->getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oMapper->updateToDb($oType);
                $this->redirect('/document/viewAttributeType');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function deleteattributetypeAction()
    {
        $oMapper = new TM_Document_AttributeTypeMapper();
        $oType = $oMapper->getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oMapper->deleteFromDB($oType);
            $this->redirect('/document/viewAttributeType');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function addattributehashAction()
    {
        $oMapper = new TM_Document_AttributeTypeMapper();
        $oHash = new TM_Document_Hash();

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setAttributeKey($data['attribute_key']);
            $oHash->setTitle($data['title']);
            $oHash->setType($oMapper->getInstanceById($data['type_id']));
            $oHash->setValueList($data['list_value']);

            try {
                $oHash->insertToDb();
                $this->redirect('/document/viewHash');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', $oMapper->getAllInstance());
    }

    public function editattributehashAction()
    {
        $oMapper = new TM_Document_AttributeTypeMapper();
        $oHash = TM_Document_Hash::getInstanceById($this->getRequest()->getParam('key'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setTitle($data['title']);
            $oHash->setType($oMapper->getInstanceById($data['type_id']));
            $oHash->setValueList($data['list_value']);

            try {
                $oHash->updateToDb();
                $this->redirect('/document/viewHash');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', $oMapper->getAllInstance());
    }

    public function deleteattributehashAction()
    {
        $oHash = TM_Document_Hash::getInstanceById($this->getRequest()->getParam('key'));
        try {
            $oHash->deleteFromDB();
            $this->redirect('/document/viewHash');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function showdiscussionAction()
    {
        $oDocument = TM_Document_Document::getInstanceById($this->getRequest()->getParam('idDocument'));
        $oTopic = TM_Discussion_Discussion::getTopicByDocument($this->_user, $oDocument);

        if ($oTopic === false) {
            $temp = TM_Task_Task::getTaskByDocument($this->_user, $oDocument->getParent());
            $oTask = $temp[0];
            //print_r($oTask);

            if (is_null($oTask)) {
                $temp = TM_Task_Task::getTaskByDocument($this->_user, $oDocument->getParent()->getParent());
                $oTask = $temp[0];
            }

            $parentTopic = TM_Discussion_Discussion::getTopicByTask($this->_user, $oTask);


            $oTopic = new TM_Discussion_Discussion();
            $oTopic->setUser($this->_user);
            $oTopic->setDateCreate(date('d.m.Y H:i:s'));
            $oTopic->setIsMessage(false);
            $oTopic->setMessage($oDocument->getTitle());

            $oTopic->setTopic($parentTopic);
            $oTopic->insertToDb();
            $oTopic->setLinkToDocument($oDocument);

            $topicAcl = TM_Acl_DiscussionAcl::getAllInstance($oTopic->getTopic());
            if (!empty($topicAcl)) {
                foreach ($topicAcl as $acl) {
                    $tempAcl = new TM_Acl_DiscussionAcl($oTopic);
                    $tempAcl->setUser($acl->getUser());
                    $tempAcl->setIsRead($acl->getIsRead());
                    $tempAcl->setIsWrite($acl->getIsWrite());
                    $tempAcl->saveToDb();
                }
            }
        }

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDiscussion = new TM_Discussion_Discussion();
            $oDiscussion->setUser($this->_user);
            $oDiscussion->setDateCreate(date('d.m.Y H:i:s'));
            $oDiscussion->setIsMessage(true);
            $oDiscussion->setMessage($data['message']);

            $oDiscussion->setTopic($oTopic);

            if (isset($data['parent'])) {
                $oDiscussion->setParent(TM_Discussion_Discussion::getInstanceById($data['parent']));
            }

            try {
                $oDiscussion->insertToDb();
                $oDiscussion->setLinkToDocument($oDocument);

                $topicAcl = TM_Acl_DiscussionAcl::getAllInstance($oTopic);
                if (!empty($topicAcl)) {
                    foreach ($topicAcl as $acl) {
                        $tempAcl = new TM_Acl_DiscussionAcl($oDiscussion);
                        $tempAcl->setUser($acl->getUser());
                        $tempAcl->setIsRead($acl->getIsRead());
                        $tempAcl->setIsWrite($acl->getIsWrite());
                        $tempAcl->saveToDb();
                    }
                }

                if (TM_FileManager_File::hasFileForUpload('file')) {
                    $oDocument = new TM_Document_Document();
                    $oDocument->setUser($this->_user);
                    $oDocument->setDateCreate(date('d.m.Y H:i:s'));
                    $oDocument->setIsFolder(false);
                    $oDocument->setTitle($data['document_title']);
                    $oDocument->setParent($oDocument->getParent());

                    $oDocument->insertToDb();
                    $oDocument->setLinkToDiscussion($oDiscussion, 1);

                    if (!empty($topicAcl)) {
                        foreach ($topicAcl as $acl) {
                            $tempAcl = new TM_Acl_DocumentAcl($oDocument);
                            $tempAcl->setUser($acl->getUser());
                            $tempAcl->setIsRead($acl->getIsRead());
                            $tempAcl->setIsWrite($acl->getIsWrite());
                            $tempAcl->saveToDb();
                        }
                    }
                }

                $this->redirect('/document/showDiscussion/parent/' . $this->getRequest()->getParam('parent', 0) . '/idDocument/' . $this->getRequest()->getParam('idDocument'));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }
        }

        $this->view->assign('discussionList', TM_Discussion_Discussion::getDiscussionTreeByDocument($this->_user, $oDocument));
        $this->view->assign('topic', $oTopic);
        $this->view->assign('document', $oDocument);
    }

}