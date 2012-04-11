<?php

class OrganizationController extends Zend_Controller_Action
{
    protected $_user = null;

    public function init()
    {
        /* Initialize action controller here */
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $this->_user = TM_User_User::getInstanceById($storage_data->id);

        $this->_helper->AjaxContext()->addActionContext('add', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('edit', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('delete', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('view', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('info', 'html')->initContext('html');
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        $oOrganization = new TM_Organization_Organization();
        //$oOrganization->setUser($this->_user);
        //$oOrganization->setDateCreate(date('d.m.Y H:i:s'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oOrganization->setTitle($data['title']);
            //$oOrganization->setDateCreate($data['date_create']);
            //$oOrganization->setType($data['type']);

            foreach ($data['attribute'] as $key => $value) {
                $oOrganization->setAttribute($key, $value);
            }


            try {
                $oOrganization->insertToDb();

                TM_Activity_ActivityLogger::logMessage($this->_user, 'Пользователи', 'Добавлена организация ' . $oOrganization->getTitle(), $oOrganization);

                if ($this->_request->isXmlHttpRequest()) {
                    exit;
                } else {
                    $this->_redirect('/user/index/');
                }
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('attributeHashList', TM_Organization_Hash::getAllInstance());
        $this->view->assign('organization', $oOrganization);
    }

    public function editAction()
    {
        $oOrganization = TM_Organization_Organization::getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oOrganization->setTitle($data['title']);
            //$oOrganization->setDateCreate($data['date_create']);

            foreach ($data['attribute'] as $key => $value) {
                $oOrganization->setAttribute($key, $value);
            }

            try {
                $oOrganization->updateToDb();

                TM_Activity_ActivityLogger::logMessage($this->_user, 'Проекты', 'Изменения в задаче ' . $oOrganization->getTitle(), $oOrganization);

                if ($this->_request->isXmlHttpRequest()) {
                    exit;
                } else {
                    $this->_redirect('/user/index/');
                }
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('attributeHashList', TM_Organization_Hash::getAllInstance($oOrganization));
        $this->view->assign('organization', $oOrganization);
    }

    public function viewAction()
    {
        $oOrganization = TM_Organization_Organization::getInstanceById($this->getRequest()->getParam('id'));
        $this->view->assign('attributeHashList', TM_Organization_Hash::getAllInstance($oOrganization));
        $this->view->assign('organization', $oOrganization);
    }

    public function infoAction()
    {
        $oOrganization = TM_Organization_Organization::getInstanceById($this->getRequest()->getParam('id'));
        $this->view->assign('attributeHashList', TM_Organization_Hash::getAllInstance($oOrganization));
        $this->view->assign('organization', $oOrganization);
    }

    public function deleteAction()
    {
        $oOrganization = TM_Organization_Organization::getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oOrganization->deleteFromDB();

            TM_Activity_ActivityLogger::logMessage($this->_user, 'Проекты', 'Удалена задача ' . $oOrganization->getTitle(), $oOrganization);
            if ($this->_request->isXmlHttpRequest()) {
                exit;
            } else {
                $this->_redirect('/user/index/');
            }
        } catch (Exception $e) {
            $this->view->assign('exception_msg', $e->getMessage());
        }
        // action body
    }

    public function viewattributetypeAction()
    {
        $this->view->assign('attributeTypeList', TM_Attribute_AttributeType::getAllInstance(new TM_Organization_AttributeTypeMapper()));
    }

    public function viewhashAction()
    {
        $this->view->assign('attributeHashList', TM_Organization_Hash::getAllInstance());
    }

    public function addattributetypeAction()
    {
        $oType = new TM_Attribute_AttributeType(new TM_Organization_AttributeTypeMapper());

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oType->insertToDb();
                $this->_redirect('/organization/viewAttributeType');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function editattributetypeAction()
    {
        $oType = TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Organization_AttributeTypeMapper(), $this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oType->updateToDb();
                $this->_redirect('/organization/viewAttributeType');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function deleteattributetypeAction()
    {
        $oType = TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Organization_AttributeTypeMapper(), $this->getRequest()->getParam('id'));
        try {
            $oType->deleteFromDB();
            $this->_redirect('/organization/viewAttributeType');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function addattributehashAction()
    {
        $oHash = new TM_Organization_Hash();
        $oHash->setIsRequired(false);
        $oHash->setSortOrder(1000);

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setAttributeKey($data['attribute_key']);
            $oHash->setTitle($data['title']);
            $oHash->setType(TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Organization_AttributeTypeMapper(), $data['type_id']));
            $oHash->setValueList($data['list_value']);
            $oHash->setListOrder($data['list_order']);
            $oHash->setIsRequired($data['required']);
            $oHash->setSortOrder($data['sort_order']);

            try {
                $oHash->insertToDb();
                $this->_redirect('/organization/viewHash');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', TM_Attribute_AttributeType::getAllInstance(new TM_Organization_AttributeTypeMapper()));
    }

    public function editattributehashAction()
    {
        $oHash = TM_Organization_Hash::getInstanceById($this->getRequest()->getParam('key'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setTitle($data['title']);
            $oHash->setType(TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Organization_AttributeTypeMapper(), $data['type_id']));
            $oHash->setValueList($data['list_value']);
            $oHash->setListOrder($data['list_order']);
            $oHash->setIsRequired($data['required']);
            $oHash->setSortOrder($data['sort_order']);

            try {
                $oHash->updateToDb();
                $this->_redirect('/organization/viewHash');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', TM_Attribute_AttributeType::getAllInstance(new TM_Organization_AttributeTypeMapper()));
    }

    public function deleteattributehashAction()
    {
        $oHash = TM_Organization_Hash::getInstanceById($this->getRequest()->getParam('key'));
        try {
            $oHash->deleteFromDB();
            $this->_redirect('/organization/viewHash');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


}

