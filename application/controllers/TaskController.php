<?php

class TaskController extends Zend_Controller_Action
{

    protected $_user = null;

    public function init()
    {
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $this->_user = TM_User_User::getInstanceById($storage_data->id);
    }

    public function indexAction()
    {
        $parentId = $this->getRequest()->getParam('parent', 0);
        $this->view->assign('taskList', TM_Task_Task::getAllInstance($this->_user, $parentId));

        if ($parentId != 0) {
            $curTask = TM_Task_Task::getInstanceById($parentId);
            
            $this->view->assign('task', $curTask);
            $this->view->assign('breadcrumbs', $curTask->getPathToTask());
        }

        $this->view->assign('attributeTypeList', TM_Attribute_AttributeType::getAllInstance(new TM_Task_AttributeTypeMapper()));
        $this->view->assign('attributeHashList', TM_Task_Hash::getAllInstance());
    }

    public function addAction()
    {
        $oTask = new TM_Task_Task();
        $oTask->setUser($this->_user);
        $oTask->setDateCreate(date('d.m.Y H:i:s'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oTask->setTitle($data['title']);
            $oTask->setDateCreate($data['date_create']);

            if (!empty($data['parentTask'])) {
                $oTask->addParent(TM_Task_Task::getInstanceById($data['parentTask']));
            }

            try {
                $oTask->insertToDb();
                $this->_redirect('/task/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Task_Task::getAllInstance($this->_user, -1));
        $this->view->assign('task', $oTask);
    }

    public function editAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oTask->setTitle($data['title']);
            $oTask->setDateCreate($data['date_create']);

            if (!empty($data['parentTask'])) {
                $oTask->addParent(TM_Task_Task::getInstanceById($data['parentTask']));
            }

            foreach ($data['attribute'] as $key => $value) {
                $oTask->setAttribute($key, $value);
            }

            if (!empty($data['document_title'])) {
                $oDocument = new TM_Document_Document();
                $oDocument->setUser($this->_user);
                $oDocument->setDateCreate(date('d.m.Y H:i:s'));
                $oDocument->setIsFolder(false);
                $oDocument->setTitle($data['document_title']);

                $oDocument->insertToDb();
                $oDocument->setLinkToTask($oTask);
            }

            try {
                $oTask->updateToDb();
                $this->_redirect('/task/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Task_Task::getAllInstance($this->_user), -1);
        $this->view->assign('attributeHashList', TM_Task_Hash::getAllInstance());
        $this->view->assign('documentList', TM_Document_Document::getDocumentByTask($this->_user, $oTask));
        $this->view->assign('task', $oTask);
    }

    public function deleteAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oTask->deleteFromDB();
            $this->_redirect('/task/index/parent/' . $this->getRequest()->getParam('parent', 0));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());

        }
        // action body
    }

    public function deletelinktodocAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('id'));
        $oDocument = TM_Document_Document::getInstanceById($this->getRequest()->getParam('doc_id'));
        $oDocument->deleteLinkToTask($oTask);
        $this->_redirect('/task/edit/parent/' . $this->getRequest()->getParam('parent', 0) . '/id/' . $this->getRequest()->getParam('id'));
    }

    public function addattributetypeAction()
    {
        $oType = new TM_Attribute_AttributeType(new TM_Task_AttributeTypeMapper());

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oType->insertToDb();
                $this->_redirect('/task/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }
        
        $this->view->assign('type', $oType);
    }

    public function editattributetypeAction()
    {
       $oType = TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Task_AttributeTypeMapper(), $this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oType->updateToDb();
                $this->_redirect('/task/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function deleteattributetypeAction()
    {
        $oType = TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Task_AttributeTypeMapper(), $this->getRequest()->getParam('id'));
        try {
            $oType->deleteFromDB();
            $this->_redirect('/task/index/parent/' . $this->getRequest()->getParam('parent', 0));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function addattributehashAction()
    {
        $oHash = new TM_Task_Hash();

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setAttributeKey($data['attribute_key']);
            $oHash->setTitle($data['title']);
            $oHash->setType(TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Task_AttributeTypeMapper(), $data['type_id']));
            $oHash->setValueList($data['list_value']);

            try {
                $oHash->insertToDb();
                $this->_redirect('/task/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', TM_Attribute_AttributeType::getAllInstance(new TM_Task_AttributeTypeMapper()));
    }

    public function editattributehashAction()
    {
        $oHash = TM_Task_Hash::getInstanceById($this->getRequest()->getParam('key'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setTitle($data['title']);
            $oHash->setType(TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Task_AttributeTypeMapper(), $data['type_id']));
            $oHash->setValueList($data['list_value']);

            try {
                $oHash->updateToDb();
                $this->_redirect('/task/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', TM_Attribute_AttributeType::getAllInstance(new TM_Task_AttributeTypeMapper()));
    }

    public function deleteattributehashAction()
    {
        $oHash = TM_Task_Hash::getInstanceById($this->getRequest()->getParam('key'));
        try {
            $oHash->deleteFromDB();
            $this->_redirect('/task/index/parent/' . $this->getRequest()->getParam('parent', 0));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


}













