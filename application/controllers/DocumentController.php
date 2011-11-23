<?php

class DocumentController extends Zend_Controller_Action
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
        $this->view->assign('documentList', TM_Document_Document::getAllInstance($this->_user, $parentId));

        if ($parentId != 0) {
            $curDocument = TM_Document_Document::getInstanceById($parentId);
            
            $this->view->assign('document', $curDocument);
            $this->view->assign('breadcrumbs', $curDocument->getPathToDocument());
        }

        $this->view->assign('attributeTypeList', TM_Attribute_AttributeType::getAllInstance(new TM_Document_AttributeTypeMapper()));
        $this->view->assign('attributeHashList', TM_Document_Hash::getAllInstance());
    }

    public function addAction()
    {
        $oDocument = new TM_Document_Document();
        $oDocument->setUser($this->_user);
        $oDocument->setDateCreate(date('d.m.Y H:i:s'));
        $oDocument->setIsFolder(false);

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDocument->setTitle($data['title']);
            $oDocument->setDateCreate($data['date_create']);

            if (!empty($data['parentDocument'])) {
                $oDocument->setParent(TM_Document_Document::getInstanceById($data['parentDocument']));
            }

            try {
                $oDocument->insertToDb();
                $this->_redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
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
                $this->_redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Document_Document::getAllInstance($this->_user, -1, 1));
        $this->view->assign('attributeHashList', TM_Document_Hash::getAllInstance());
        $this->view->assign('taskList', TM_Task_Task::getTaskByDocument($this->_user, $oDocument));
        $this->view->assign('document', $oDocument);
    }

    public function addfolderAction()
    {
        $oDocument = new TM_Document_Document();
        $oDocument->setUser($this->_user);
        $oDocument->setDateCreate(date('d.m.Y H:i:s'));
        $oDocument->setIsFolder(true);

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDocument->setTitle($data['title']);
            $oDocument->setDateCreate($data['date_create']);


            if (!empty($data['parentDocument'])) {
                $oDocument->setParent(TM_Document_Document::getInstanceById($data['parentDocument']));
            }

            try {
                $oDocument->insertToDb();
                $this->_redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
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
                $this->_redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Document_Document::getAllInstance($this->_user), -1);
        $this->view->assign('attributeHashList', TM_Document_Hash::getAllInstance());
        $this->view->assign('document', $oDocument);
    }

    public function deleteAction()
    {
        $oDocument = TM_Document_Document::getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oDocument->deleteFromDB();
            $this->_redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());

        }
        // action body
    }

    public function addattributetypeAction()
    {
        $oType = new TM_Attribute_AttributeType(new TM_Document_AttributeTypeMapper());

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oType->insertToDb();
                $this->_redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }
        
        $this->view->assign('type', $oType);
    }

    public function editattributetypeAction()
    {
       $oType = TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Document_AttributeTypeMapper(), $this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oType->updateToDb();
                $this->_redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function deleteattributetypeAction()
    {
        $oType = TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Document_AttributeTypeMapper(), $this->getRequest()->getParam('id'));
        try {
            $oType->deleteFromDB();
            $this->_redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function addattributehashAction()
    {
        $oHash = new TM_Document_Hash();

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setAttributeKey($data['attribute_key']);
            $oHash->setTitle($data['title']);
            $oHash->setType(TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Document_AttributeTypeMapper(), $data['type_id']));
            $oHash->setValueList($data['list_value']);

            try {
                $oHash->insertToDb();
                $this->_redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', TM_Attribute_AttributeType::getAllInstance(new TM_Document_AttributeTypeMapper()));
    }

    public function editattributehashAction()
    {
        $oHash = TM_Document_Hash::getInstanceById($this->getRequest()->getParam('key'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setTitle($data['title']);
            $oHash->setType(TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Document_AttributeTypeMapper(), $data['type_id']));
            $oHash->setValueList($data['list_value']);

            try {
                $oHash->updateToDb();
                $this->_redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', TM_Attribute_AttributeType::getAllInstance(new TM_Document_AttributeTypeMapper()));
    }

    public function deleteattributehashAction()
    {
        $oHash = TM_Document_Hash::getInstanceById($this->getRequest()->getParam('key'));
        try {
            $oHash->deleteFromDB();
            $this->_redirect('/document/index/parent/' . $this->getRequest()->getParam('parent', 0));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


}













