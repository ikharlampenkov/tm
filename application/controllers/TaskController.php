<?php

class TaskController extends Zend_Controller_Action
{

    protected $_user = null;

    public function init()
    {
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $this->_user = TM_User_User::getInstanceById($storage_data->id);

        $this->_helper->AjaxContext()->addActionContext('add', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('showTaskBlock', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('edit', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('delete', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('view', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('info', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('toArchive', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('fromArchive', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('showArchiveBlock', 'html')->initContext('html');
    }

    public function indexAction()
    {
        $parentId = $this->getRequest()->getParam('parent', 0);

        if ($parentId != 0) {
            $curTask = TM_Task_Task::getInstanceById($parentId);

            $this->view->assign('task', $curTask);
            $this->view->assign('breadcrumbs', $curTask->getPathToTask());
        }

        $this->view->assign('taskList', TM_Task_Task::getAllInstance($this->_user, $parentId));
    }

    public function showtaskblockAction()
    {
        $parentId = $this->getRequest()->getParam('parent', 0);
        $filter_raw = $this->getRequest()->getParam('filter', 'all');
        if (is_array($filter_raw)) {
            $filter = urldecode($filter_raw[count($filter_raw) - 1]);
        } else {
            $filter = urldecode($filter_raw);
        }
        $this->view->assign('taskList', TM_Task_Task::getAllInstance($this->_user, $parentId, $filter));
    }

    public function viewattributetypeAction()
    {
        $mapper = new TM_Task_AttributeTypeMapper();
        $this->view->assign('attributeTypeList', $mapper->getAllInstance());
    }

    public function viewhashAction()
    {
        $this->view->assign('attributeHashList', TM_Task_Hash::getAllInstance());
    }

    public function showganttAction()
    {
        $this->view->assign('taskList', TM_Task_Task::getAllInstance($this->_user));
    }

    public function addAction()
    {
        $oTask = new TM_Task_Task();
        $oTask->setUser($this->_user);
        $oTask->setDateCreate(date('d.m.Y H:i:s'));
        $oTask->setType(TM_Task_Task::TASK_TYPE_PERIOD);

        if ($this->getRequest()->getParam('parent', 0) != 0) {
            $oTask->setParent(TM_Task_Task::getInstanceById($this->getRequest()->getParam('parent', 0)));
        }

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oTask->setTitle($data['title']);
            $oTask->setDateCreate($data['date_create']);
            $oTask->setType($data['type']);

            if (!empty($data['parentTask'])) {
                $parentTask = TM_Task_Task::getInstanceById($data['parentTask']);
                $oTask->setParent($parentTask);
            }

            if (isset($data['is_vip']) && $data['is_vip'] == 'on') {
                $oTask->setIsVip(true);
            } else {
                $oTask->setIsVip(false);
            }

            foreach ($data['attribute'] as $key => $value) {
                $oTask->setAttribute($key, $value);
            }

            $db = StdLib_DB::getInstance();
            $db->startTransaction();
            try {
                $oTask->insertToDb();

                //$oTask->updateToDb();

                $oDocument = new TM_Document_Document();
                $oDocument->setUser($this->_user);
                $oDocument->setDateCreate(date('d.m.Y H:i:s'));
                $oDocument->setIsFolder(true);
                $oDocument->setTitle($data['title']);

                if (!empty($data['parentTask'])) {
                    $oDocument->setParent(TM_Document_Document::getDocumentFolderByTask($this->_user, $parentTask));
                }

                $oDocument->insertToDb();
                $oDocument->setLinkToTask($oTask);


                $oDiscussion = new TM_Discussion_Discussion();
                $oDiscussion->setUser($this->_user);
                $oDiscussion->setDateCreate(date('d.m.Y H:i:s'));
                //$oDiscussion->setIsFirst(true);
                $oDiscussion->setIsMessage(false);

                $oDiscussion->setMessage($data['title']);

                if (!empty($data['parentTask'])) {
                    $oDiscussion->setTopic(TM_Discussion_Discussion::getTopicByTask($this->_user, $parentTask));
                }

                $oDiscussion->insertToDb();
                $oDiscussion->setLinkToTask($oTask);

                /*
                if (!empty($data['parentTask'])) {
                    $taskAcl = TM_Acl_TaskAcl::getAllInstance($parentTask);
                    if (!empty($taskAcl)) {
                        foreach ($taskAcl as $acl) {
                            $tempAcl = new TM_Acl_TaskAcl($oTask);
                            $tempAcl->setUser($acl->getUser());
                            $tempAcl->setIsRead($acl->getIsRead());
                            $tempAcl->setIsWrite($acl->getIsWrite());
                            $tempAcl->setIsExecutant($acl->getIsExecutant());
                            $tempAcl->saveToDb();
                        }
                    }
                }
                */

                $oFolder = TM_Document_Document::getDocumentFolderByTask($this->_user, $oTask);
                $folderAcl = TM_Acl_DocumentAcl::getAllInstance($oFolder);

                $oTopic = TM_Discussion_Discussion::getTopicByTask($this->_user, $oTask);
                $topicAcl = TM_Acl_DiscussionAcl::getAllInstance($oTopic);

                $dataAcl = $this->getRequest()->getParam('dataacl');
                foreach ($dataAcl as $idUser => $values) {

                    $taskAcl = new TM_Acl_TaskAcl($oTask);

                    $taskAcl->setUser(TM_User_User::getInstanceById($idUser));
                    if (isset($values['is_read'])) {
                        $taskAcl->setIsRead($values['is_read']);
                    } else {
                        $taskAcl->setIsRead(0);
                    }
                    if (isset($values['is_write'])) {
                        $taskAcl->setIsWrite($values['is_write']);
                    } else {
                        $taskAcl->setIsWrite(0);
                    }
                    if (isset($values['is_executant'])) {
                        $taskAcl->setIsExecutant($values['is_executant']);
                    } else {
                        $taskAcl->setIsExecutant(0);
                    }
                    $taskAcl->saveToDb();

                    if (empty($folderAcl)) {
                        $tempAcl = new TM_Acl_DocumentAcl($oFolder);
                        $tempAcl->setUser(TM_User_User::getInstanceById($idUser));
                        if (isset($values['is_read'])) {
                            $tempAcl->setIsRead($values['is_read']);
                        } else {
                            $tempAcl->setIsRead(0);
                        }
                        if (isset($values['is_write'])) {
                            $tempAcl->setIsWrite($values['is_write']);
                        } else {
                            $tempAcl->setIsWrite(0);
                        }
                        $tempAcl->saveToDb();
                    }

                    if (empty($topicAcl)) {
                        $tempAcl = new TM_Acl_DiscussionAcl($oTopic);
                        $tempAcl->setUser(TM_User_User::getInstanceById($idUser));
                        if (isset($values['is_read'])) {
                            $tempAcl->setIsRead($values['is_read']);
                        } else {
                            $tempAcl->setIsRead(0);
                        }
                        if (isset($values['is_write'])) {
                            $tempAcl->setIsWrite($values['is_write']);
                        } else {
                            $tempAcl->setIsWrite(0);
                        }
                        $tempAcl->saveToDb();
                    }
                }

                TM_Activity_ActivityLogger::logMessage($this->_user, 'Проекты', 'Добавлена задача ' . $oTask->getTitle(), $oTask);

                if (!empty($data['parentTask'])) {
                    $oTask->getParent()->reCalculateDeadLine();
                    $oTask->getParent()->reCalculateState();
                }

                $db->commitTransaction();
                if ($this->_request->isXmlHttpRequest() || true) {
                    exit;
                } else {
                    $this->redirect('/task/index/parent/' . $this->getRequest()->getParam('parent', 0));
                }
            } catch (Exception $e) {
                $db->rollbackTransaction();
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Task_Task::getAllInstance($this->_user));
        $this->view->assign('attributeHashList', TM_Task_Hash::getAllInstance());
        $this->view->assign('task', $oTask);
        $this->view->assign('taskTypeList', $oTask->getTypeList());

        $this->view->assign('userList', TM_User_User::getAllInstance());
        if ($this->getRequest()->getParam('parent', 0) != 0) {
            $this->view->assign('taskAcl', TM_Acl_TaskAcl::getAllInstance(TM_Task_Task::getInstanceById($this->getRequest()->getParam('parent', 0))));
        }

    }

    public function editAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $db = StdLib_DB::getInstance();
            $db->startTransaction();

            $data = $this->getRequest()->getParam('data');
            $oTask->setTitle($data['title']);
            $oTask->setDateCreate($data['date_create']);
            $oTask->setType($data['type']);

            try {
                if (!empty($data['parentTask'])) {
                    $oParent = TM_Task_Task::getInstanceById($data['parentTask']);
                    if (($oTask->hasParent() && $oTask->getParent()->getId() !== $oParent->getId()) || !$oTask->hasParent()) {
                        //смена родителя у папки для задачи
                        $tempFolder = TM_Document_Document::getDocumentFolderByTask($this->_user, $oTask);
                        $tempFolder->setParent(TM_Document_Document::getDocumentFolderByTask($this->_user, $oParent));
                        $tempFolder->updateToDb();

                        //смена родителя у обсуждения для задачи
                        $tempTopic = TM_Discussion_Discussion::getTopicByTask($this->_user, $oTask);
                        $tempTopic->setTopic(TM_Discussion_Discussion::getTopicByTask($this->_user, $oParent));
                        $tempTopic->updateToDb();
                    }

                    $oTask->setParent($oParent);
                } else {
                    if ($oTask->hasParent()) {
                        //смена родителя у папки для задачи
                        $tempFolder = TM_Document_Document::getDocumentFolderByTask($this->_user, $oTask);
                        $tempFolder->setParent(null);
                        $tempFolder->updateToDb();

                        //смена родителя у обсуждения для задачи
                        $tempTopic = TM_Discussion_Discussion::getTopicByTask($this->_user, $oTask);
                        $tempTopic->setTopic(null);
                        $tempTopic->updateToDb();
                    }
                    $oTask->setParent(null);
                }

                if (isset($data['is_vip']) && $data['is_vip'] == 'on') {
                    $oTask->setIsVip(true);
                } else {
                    $oTask->setIsVip(false);
                }

                foreach ($data['attribute'] as $key => $value) {
                    $oTask->setAttribute($key, $value);
                }

                if (TM_FileManager_File::hasFileForUpload('file')) {
                    $oDocument = new TM_Document_Document();
                    $oDocument->setUser($this->_user);
                    $oDocument->setDateCreate(date('d.m.Y H:i:s'));
                    $oDocument->setIsFolder(false);
                    $oDocument->setTitle($data['document_title']);
                    $oDocument->setParent(TM_Document_Document::getDocumentFolderByTask($this->_user, $oTask));

                    $oDocument->setAttribute('description', $data['document_description']);

                    $oDocument->insertToDb();
                    $oDocument->setLinkToTask($oTask);
                }


                $oTask->updateToDb();

                $oFolder = TM_Document_Document::getDocumentFolderByTask($this->_user, $oTask);
                $folderAcl = TM_Acl_DocumentAcl::getAllInstance($oFolder);

                $oTopic = TM_Discussion_Discussion::getTopicByTask($this->_user, $oTask);
                $topicAcl = TM_Acl_DiscussionAcl::getAllInstance($oTopic);

                $dataAcl = $this->getRequest()->getParam('dataacl');
                foreach ($dataAcl as $idUser => $values) {

                    $taskAcl = new TM_Acl_TaskAcl($oTask);

                    $taskAcl->setUser(TM_User_User::getInstanceById($idUser));
                    if (isset($values['is_read'])) {
                        $taskAcl->setIsRead($values['is_read']);
                    } else {
                        $taskAcl->setIsRead(0);
                    }
                    if (isset($values['is_write'])) {
                        $taskAcl->setIsWrite($values['is_write']);
                    } else {
                        $taskAcl->setIsWrite(0);
                    }
                    if (isset($values['is_executant'])) {
                        $taskAcl->setIsExecutant($values['is_executant']);
                    } else {
                        $taskAcl->setIsExecutant(0);
                    }
                    $taskAcl->saveToDb();

                    if (empty($folderAcl)) {
                        $tempAcl = new TM_Acl_DocumentAcl($oFolder);
                        $tempAcl->setUser(TM_User_User::getInstanceById($idUser));
                        if (isset($values['is_read'])) {
                            $tempAcl->setIsRead($values['is_read']);
                        } else {
                            $tempAcl->setIsRead(0);
                        }
                        if (isset($values['is_write'])) {
                            $tempAcl->setIsWrite($values['is_write']);
                        } else {
                            $tempAcl->setIsWrite(0);
                        }
                        $tempAcl->saveToDb();
                    }

                    if (empty($topicAcl)) {
                        $tempAcl = new TM_Acl_DiscussionAcl($oTopic);
                        $tempAcl->setUser(TM_User_User::getInstanceById($idUser));
                        if (isset($values['is_read'])) {
                            $tempAcl->setIsRead($values['is_read']);
                        } else {
                            $tempAcl->setIsRead(0);
                        }
                        if (isset($values['is_write'])) {
                            $tempAcl->setIsWrite($values['is_write']);
                        } else {
                            $tempAcl->setIsWrite(0);
                        }
                        $tempAcl->saveToDb();
                    }
                }

                TM_Activity_ActivityLogger::logMessage($this->_user, 'Проекты', 'Изменения в задаче ' . $oTask->getTitle(), $oTask);

                if (!empty($data['parentTask'])) {
                    $oTask->getParent()->reCalculateDeadLine();
                    $oTask->getParent()->reCalculateState();
                }

                $db->commitTransaction();

                if ($this->_request->isXmlHttpRequest() || true) {
                    exit;
                } else {
                    $this->redirect('/task/index/parent/' . $this->getRequest()->getParam('parent', 0));
                }
            } catch (Exception $e) {
                $db->rollbackTransaction();
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Task_Task::getAllInstance($this->_user));
        $this->view->assign('attributeHashList', TM_Task_Hash::getAllInstance($oTask));
        $this->view->assign('documentList', TM_Document_Document::getDocumentByTask($this->_user, $oTask));
        $this->view->assign('task', $oTask);
        $this->view->assign('taskTypeList', $oTask->getTypeList());

        $this->view->assign('taskAcl', TM_Acl_TaskAcl::getAllInstance($oTask));
        $this->view->assign('userList', TM_User_User::getAllInstance());
    }

    public function viewAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('id'));
        $this->view->assign('attributeHashList', TM_Task_Hash::getAllInstance($oTask));
        $this->view->assign('documentList', TM_Document_Document::getDocumentByTask($this->_user, $oTask));
        $this->view->assign('task', $oTask);
    }

    public function infoAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('id'));
        $this->view->assign('attributeHashList', TM_Task_Hash::getAllInstance($oTask));
        $this->view->assign('documentList', TM_Document_Document::getDocumentByTask($this->_user, $oTask));
        $this->view->assign('task', $oTask);
    }

    public function deleteAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oTask->deleteFromDB();

            TM_Activity_ActivityLogger::logMessage($this->_user, 'Проекты', 'Удалена задача ' . $oTask->getTitle(), $oTask);
            if ($this->_request->isXmlHttpRequest()) {
                exit;
            } else {
                $this->redirect('/task/index/parent/' . $this->getRequest()->getParam('parent', 0));
            }
        } catch (Exception $e) {
            $this->view->assign('exception_msg', $e->getMessage());
        }
        // action body
    }

    public function deletelinktodocAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('id'));
        $oDocument = TM_Document_Document::getInstanceById($this->getRequest()->getParam('doc_id'));
        $oDocument->deleteLinkToTask($oTask);
        $this->redirect('/task/');
        //$this->redirect('/task/edit/parent/' . $this->getRequest()->getParam('parent', 0) . '/id/' . $this->getRequest()->getParam('id'));
    }

    public function showaclAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('idTask'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oFolder = TM_Document_Document::getDocumentFolderByTask($this->_user, $oTask);
            $folderAcl = TM_Acl_DocumentAcl::getAllInstance($oFolder);

            $oTopic = TM_Discussion_Discussion::getTopicByTask($this->_user, $oTask);
            $topicAcl = TM_Acl_DiscussionAcl::getAllInstance($oTopic);

            try {
                foreach ($data as $idUser => $values) {

                    $taskAcl = new TM_Acl_TaskAcl($oTask);

                    $taskAcl->setUser(TM_User_User::getInstanceById($idUser));
                    if (isset($values['is_read'])) {
                        $taskAcl->setIsRead($values['is_read']);
                    } else {
                        $taskAcl->setIsRead(0);
                    }
                    if (isset($values['is_write'])) {
                        $taskAcl->setIsWrite($values['is_write']);
                    } else {
                        $taskAcl->setIsWrite(0);
                    }
                    if (isset($values['is_executant'])) {
                        $taskAcl->setIsExecutant($values['is_executant']);
                    } else {
                        $taskAcl->setIsExecutant(0);
                    }
                    $taskAcl->saveToDb();

                    if (empty($folderAcl)) {
                        $tempAcl = new TM_Acl_DocumentAcl($oFolder);
                        $tempAcl->setUser(TM_User_User::getInstanceById($idUser));
                        if (isset($values['is_read'])) {
                            $tempAcl->setIsRead($values['is_read']);
                        } else {
                            $tempAcl->setIsRead(0);
                        }
                        if (isset($values['is_write'])) {
                            $tempAcl->setIsWrite($values['is_write']);
                        } else {
                            $tempAcl->setIsWrite(0);
                        }
                        $tempAcl->saveToDb();
                    }

                    if (empty($topicAcl)) {
                        $tempAcl = new TM_Acl_DiscussionAcl($oTopic);
                        $tempAcl->setUser(TM_User_User::getInstanceById($idUser));
                        if (isset($values['is_read'])) {
                            $tempAcl->setIsRead($values['is_read']);
                        } else {
                            $tempAcl->setIsRead(0);
                        }
                        if (isset($values['is_write'])) {
                            $tempAcl->setIsWrite($values['is_write']);
                        } else {
                            $tempAcl->setIsWrite(0);
                        }
                        $tempAcl->saveToDb();
                    }
                }

                $this->redirect('/task/');
                //$this->redirect('/task/showAcl/parent/' . $this->getRequest()->getParam('parent', 0) . '/idTask/' . $this->getRequest()->getParam('idTask'));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }
        }

        $this->view->assign('taskAcl', TM_Acl_TaskAcl::getAllInstance($oTask));
        $this->view->assign('userList', TM_User_User::getAllInstance());
        $this->view->assign('task', $oTask);
    }

    public function addattributetypeAction()
    {
        $oMapper = new TM_Task_AttributeTypeMapper();
        $oType = new TM_Attribute_AttributeType();

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oMapper->insertToDB($oType);
                $this->redirect('/task/viewAttributeType');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function editattributetypeAction()
    {
        $oMapper = new TM_Task_AttributeTypeMapper();
        $oType = TM_Attribute_AttributeTypeFactory::getAttributeTypeById($oMapper, $this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oMapper->updateToDb($oType);
                $this->redirect('/task/viewAttributeType');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function deleteattributetypeAction()
    {
        $oMapper = new TM_Task_AttributeTypeMapper();
        $oType = TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Task_AttributeTypeMapper(), $this->getRequest()->getParam('id'));
        try {
            $oMapper->deleteFromDB($oType);
            $this->redirect('/task/viewAttributeType');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function addattributehashAction()
    {
        $oHash = new TM_Task_Hash();
        $oHash->setIsRequired(false);
        $oHash->setSortOrder(1000);

        $oMapper = new TM_Task_AttributeTypeMapper();

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setAttributeKey($data['attribute_key']);
            $oHash->setTitle($data['title']);
            $oHash->setType($oMapper->getInstanceById($data['type_id']));
            $oHash->setValueList($data['list_value']);
            $oHash->setListOrder($data['list_order']);
            $oHash->setIsRequired($data['required']);
            $oHash->setSortOrder($data['sort_order']);

            try {
                $oHash->insertToDb();
                $this->redirect('/task/viewHash');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', $oMapper->getAllInstance());
    }

    public function editattributehashAction()
    {
        $oMapper = new TM_Task_AttributeTypeMapper();
        $oHash = TM_Task_Hash::getInstanceById($this->getRequest()->getParam('key'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setTitle($data['title']);
            $oHash->setType($oMapper->getInstanceById($data['type_id']));
            $oHash->setValueList($data['list_value']);
            $oHash->setListOrder($data['list_order']);
            $oHash->setIsRequired($data['required']);
            $oHash->setSortOrder($data['sort_order']);

            try {
                $oHash->updateToDb();
                $this->redirect('/task/viewHash');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', $oMapper->getAllInstance());
    }

    public function deleteattributehashAction()
    {
        $oHash = TM_Task_Hash::getInstanceById($this->getRequest()->getParam('key'));
        try {
            $oHash->deleteFromDB();
            $this->redirect('/task/viewHash');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function showdiscussionAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('idTask'));
        $oTopic = TM_Discussion_Discussion::getTopicByTask($this->_user, $oTask);


        if ($this->getRequest()->getParam('is_complete')) {
            $oDiscussion = TM_Discussion_Discussion::getInstanceById($this->getRequest()->getParam('is_complete'));
            $oDiscussion->setIsComplete(true);

            $oDiscussion->updateToDb();
            $this->redirect('/task/showDiscussion/parent/' . $this->getRequest()->getParam('parent', 0) . '/idTask/' . $this->getRequest()->getParam('idTask'));
        }

        if ($this->getRequest()->getParam('delete')) {
            $oDiscussion = TM_Discussion_Discussion::getInstanceById($this->getRequest()->getParam('delete'));

            $oDiscussion->deleteFromDb();
            $this->redirect('/task/showDiscussion/parent/' . $this->getRequest()->getParam('parent', 0) . '/idTask/' . $this->getRequest()->getParam('idTask'));
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

            if (isset($data['to']) && $data['to'] != '') {
                $oDiscussion->setToUser(TM_User_User::getInstanceById($data['to']));
            }

            if (isset($data['is_request']) && $data['is_request'] == 'on') {
                $oDiscussion->setIsRequest(true);
            }

            try {
                $oDiscussion->insertToDb();
                $oDiscussion->setLinkToTask($oTask);

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
                    $oDocument->setParent(TM_Document_Document::getDocumentFolderByTask($this->_user, $oTask));

                    $oDocument->setAttribute('description', $data['document_description']);

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

                $this->redirect('/task/showDiscussion/parent/' . $this->getRequest()->getParam('parent', 0) . '/idTask/' . $this->getRequest()->getParam('idTask'));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }
        }

        $this->view->assign('discussionList', TM_Discussion_Discussion::getDiscussionTreeByTask($this->_user, $oTask));
        $this->view->assign('topic', $oTopic);
        $this->view->assign('task', $oTask);

        $this->view->assign('userList', TM_User_User::getAllInstance());
    }

    public function archiveAction()
    {
        $this->view->assign('taskList', TM_Task_Task::getAllInstance($this->_user, 0, 'all', true));
    }

    public function showarchiveblockAction()
    {
        $parentId = $this->getRequest()->getParam('parent', 0);
        $filter_raw = $this->getRequest()->getParam('filter', 'all');
        if (is_array($filter_raw)) {
            $filter = urldecode($filter_raw[count($filter_raw) - 1]);
        } else {
            $filter = urldecode($filter_raw);
        }
        $this->view->assign('taskList', TM_Task_Task::getAllInstance($this->_user, $parentId, $filter, true));
    }

    public function toarchiveAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('idTask'));
        $oFolder = TM_Document_Document::getDocumentFolderByTask($this->_user, $oTask);
        $oTopic = TM_Discussion_Discussion::getTopicByTask($this->_user, $oTask);

        try {
            $oTask->toArchive();
            $oFolder->toArchive();
            $oTopic->toArchive();
        } catch (Exception $e) {

        }
    }

    public function fromarchiveAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('idTask'));
        $oFolder = TM_Document_Document::getDocumentFolderByTask($this->_user, $oTask);
        $oTopic = TM_Discussion_Discussion::getTopicByTask($this->_user, $oTask);

        try {
            $oTask->fromArchive();
            $oFolder->fromArchive();
            $oTopic->fromArchive();
        } catch (Exception $e) {

        }
    }


}

