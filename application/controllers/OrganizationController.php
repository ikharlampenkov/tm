<?php

class OrganizationController extends Zend_Controller_Action
{
    protected $_user = null;

    public function init()
    {
        /* Initialize action controller here */
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $this->_user = TM_User_User::getInstanceById($storage_data->id);

        $this->_helper->AjaxContext()->addActionContext('index', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('add', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('edit', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('delete', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('view', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('info', 'html')->initContext('html');
    }

    public function indexAction()
    {
        $userType = $this->getRequest()->getParam('userType', 'client');
        $organizationId = $this->getRequest()->getParam('organizationId', null);

        $this->view->assign('userType', $userType);
        $this->view->assign('organizationList', TM_Organization_Organization::getAllInstance($this->_user));
        $this->view->assign('organizationId', $organizationId);
    }

    public function addAction()
    {
        $oOrganization = new TM_Organization_Organization();
        $oOrganization->setUser($this->_user);
        $oOrganization->setDateCreate(date('d.m.Y H:i:s'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oOrganization->setTitle($data['title']);
            $oOrganization->setDateCreate($data['date_create']);

            foreach ($data['attribute'] as $key => $value) {
                $oOrganization->setAttribute($key, $value);
            }


            try {
                $oOrganization->insertToDb();

                TM_Activity_ActivityLogger::logMessage($this->_user, 'Организации', 'Добавлена организация ' . $oOrganization->getTitle(), $oOrganization);

                if ($this->_request->isXmlHttpRequest()) {
                    exit;
                } else {
                    $this->redirect('/user/index/');
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
            $oOrganization->setDateCreate($data['date_create']);

            foreach ($data['attribute'] as $key => $value) {
                $oOrganization->setAttribute($key, $value);
            }

            try {
                $oOrganization->updateToDb();

                TM_Activity_ActivityLogger::logMessage($this->_user, 'Организации', 'Изменения в организации ' . $oOrganization->getTitle(), $oOrganization);

                if ($this->_request->isXmlHttpRequest()) {
                    exit;
                } else {
                    $this->redirect('/user/index/');
                }
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('attributeHashList', TM_Organization_Hash::getAllInstance($oOrganization));
        $this->view->assign('organization', $oOrganization);
    }

    public function deleteAction()
    {
        $oOrganization = TM_Organization_Organization::getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oOrganization->deleteFromDB();

            TM_Activity_ActivityLogger::logMessage($this->_user, 'Организации', 'Удалена организация ' . $oOrganization->getTitle(), $oOrganization);
            if ($this->_request->isXmlHttpRequest()) {
                exit;
            } else {
                $this->redirect('/user/index/');
            }
        } catch (Exception $e) {
            $this->view->assign('exception_msg', $e->getMessage());
        }
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

    public function viewattributetypeAction()
    {
        $oMapper = new TM_Organization_AttributeTypeMapper();
        $this->view->assign('attributeTypeList', $oMapper->getAllInstance());
    }

    public function viewhashAction()
    {
        $this->view->assign('attributeHashList', TM_Organization_Hash::getAllInstance());
    }

    public function addattributetypeAction()
    {
        $oMapper = new TM_Organization_AttributeTypeMapper();
        $oType = new TM_Attribute_AttributeType();

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oMapper->insertToDb($oType);
                $this->redirect('/organization/viewAttributeType/');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function editattributetypeAction()
    {
        $oMapper = new TM_Organization_AttributeTypeMapper();
        $oType = $oMapper->getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oMapper->updateToDb($oType);
                $this->redirect('/organization/viewAttributeType');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function deleteattributetypeAction()
    {
        $oMapper = new TM_Organization_AttributeTypeMapper();
        $oType = $oMapper->getInstanceById($this->getRequest()->getParam('id'));

        try {
            $oMapper->deleteFromDB($oType);
            $this->redirect('/organization/viewAttributeType');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function addattributehashAction()
    {
        $oMapper = new TM_Organization_AttributeTypeMapper();

        $oHash = new TM_Organization_Hash();
        $oHash->setIsRequired(false);
        $oHash->setSortOrder(1000);

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
                $this->redirect('/organization/viewHash');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', $oMapper->getAllInstance());
    }

    public function editattributehashAction()
    {
        $oMapper = new TM_Organization_AttributeTypeMapper();
        $oHash = TM_Organization_Hash::getInstanceById($this->getRequest()->getParam('key'));

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
                $this->redirect('/organization/viewHash');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', $oMapper->getAllInstance());
    }

    public function deleteattributehashAction()
    {
        $oHash = TM_Organization_Hash::getInstanceById($this->getRequest()->getParam('key'));
        try {
            $oHash->deleteFromDB();
            $this->redirect('/organization/viewHash');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


}

