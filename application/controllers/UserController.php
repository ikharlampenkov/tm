<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->AjaxContext()->addActionContext('showUserAclBlock', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('showPrivateTask', 'html')->initContext('html');
    }

    public function indexAction()
    {
        $this->view->assign('userRoleList', TM_User_Role::getAllInstance());
        $this->view->assign('userList', TM_User_User::getAllInstance());
    }

    public function viewattributetypeAction()
    {
        $this->view->assign('attributeTypeList', TM_Attribute_AttributeType::getAllInstance(new TM_User_AttributeTypeMapper()));
    }

    public function viewhashAction()
    {
        $this->view->assign('attributeHashList', TM_User_Hash::getAllInstance());
    }

    public function viewresourceAction()
    {
        $this->view->assign('userResourceList', TM_User_Resource::getAllInstance());
    }

    public function addAction()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oUser = new TM_User_User();
            $oUser->setLogin($data['login']);
            $oUser->setDateCreate($data['date_create']);
            $oUser->setPassword($data['password']);
            $oUser->setRole(TM_User_Role::getInstanceById($data['role_id']));

            $oUser->insertToDb();
            $this->_redirect('/user');
        }

        $this->view->assign('userRoleList', TM_User_Role::getAllInstance());
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $oUser = TM_User_User::getInstanceById($id);

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');


            $oUser->setLogin($data['login']);
            $oUser->setDateCreate($data['date_create']);
            $oUser->setPassword($data['password']);
            $oUser->setRole(TM_User_Role::getInstanceById($data['role_id']));

            foreach ($data['attribute'] as $key => $value) {
                $oUser->setAttribute($key, $value);
            }

            $oUser->updateToDb();
            $this->_redirect('/user');
        }

        $this->view->assign('userRoleList', TM_User_Role::getAllInstance());
        $this->view->assign('attributeHashList', TM_User_Hash::getAllInstance($oUser));
        $this->view->assign('user', $oUser);
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');

        $oUser = TM_User_User::getInstanceById($id);
        $oUser->deleteFromDB();

        $this->_redirect('/user');
    }

    public function addroleAction()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oRole = new TM_User_Role();
            $oRole->setTitle($data['title']);
            $oRole->setRtitle($data['rtitle']);

            $oRole->insertToDb();
            $this->_redirect('/user');
        }

    }

    public function editroleAction()
    {
        $id = $this->getRequest()->getParam('id');

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oRole = TM_User_Role::getInstanceById($id);
            $oRole->setTitle($data['title']);
            $oRole->setRtitle($data['rtitle']);

            $oRole->updateToDb();
            $this->_redirect('/user');
        }

        $this->view->assign('role', TM_User_Role::getInstanceById($id));
    }

    public function deleteroleAction()
    {
        $id = $this->getRequest()->getParam('id');

        $oRole = TM_User_Role::getInstanceById($id);
        $oRole->deleteFromDB();

        $this->_redirect('/user');
    }

    public function showroleaclAction()
    {
        $oRole = TM_User_Role::getInstanceById($this->getRequest()->getParam('idRole'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            try {
                foreach ($data as $idResource => $values) {
                    $roleAcl = new TM_User_RoleAcl($oRole);
                    $roleAcl->setResource(TM_User_Resource::getInstanceById($idResource));
                    $roleAcl->setIsAllow($values['is_allow']);
                    $roleAcl->setPrivileges($values['privileges']);
                    $roleAcl->saveToDb();
                }

                $this->_redirect('/user/showRoleAcl/idRole/' . $this->getRequest()->getParam('idRole'));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }
        }

        $this->view->assign('role', $oRole);
        $this->view->assign('userResourceList', TM_User_Resource::getAllInstance());
        $this->view->assign('roleAcl', TM_User_RoleAcl::getAllInstance($oRole));
    }

    public function showuseraclAction()
    {
        $id = $this->getRequest()->getParam('id');
        $oUser = TM_User_User::getInstanceById($id);

        $this->view->assign('taskList', TM_Task_Task::getAllInstance($oUser));
        $this->view->assign('user', $oUser);
    }

    public function showuseraclblockAction()
    {
        $id = $this->getRequest()->getParam('userId');
        $parentId = $this->getRequest()->getParam('parent', 0);
        $oUser = TM_User_User::getInstanceById($id);

        $this->view->assign('taskList', TM_Task_Task::getAllInstance($oUser, $parentId));
        $this->view->assign('user', $oUser);
    }

    public function showprivatetaskAction()
    {
        $id = $this->getRequest()->getParam('userId');
        $oUser = TM_User_User::getInstanceById($id);

        $this->view->assign('taskList', TM_Task_Task::getTaskByExecutant($oUser));
        $this->view->assign('user', $oUser);
    }

    public function addresourceAction()
    {
        $oResource = new TM_User_Resource();

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oResource->setTitle($data['title']);
            $oResource->setRtitle($data['rtitle']);

            try {
                $oResource->insertToDb();
                $this->_redirect('/user/viewResource');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('resource', $oResource);
    }

    public function editresourceAction()
    {
        $oResource = TM_User_Resource::getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oResource->setTitle($data['title']);
            $oResource->setRtitle($data['rtitle']);

            try {
                $oResource->updateToDb();
                $this->_redirect('/user/viewResource');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }
        }

        $this->view->assign('resource', $oResource);
    }

    public function deleteresourceAction()
    {
        $oResource = TM_User_Resource::getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oResource->deleteFromDB();
            $this->_redirect('/user/viewResource');
        } catch (Exception $e) {
            $this->view->assign('exception_msg', $e->getMessage());
        }
    }

    public function addattributetypeAction()
    {
        $oType = new TM_Attribute_AttributeType(new TM_User_AttributeTypeMapper());

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oType->insertToDb();
                $this->_redirect('/user/viewAttributeType');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function editattributetypeAction()
    {
        $oType = TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_User_AttributeTypeMapper(), $this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oType->updateToDb();
                $this->_redirect('/user/viewAttributeType');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function deleteattributetypeAction()
    {
        $oType = TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_User_AttributeTypeMapper(), $this->getRequest()->getParam('id'));
        try {
            $oType->deleteFromDB();
            $this->_redirect('/user/viewAttributeType');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function addattributehashAction()
    {
        $oHash = new TM_User_Hash();

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setAttributeKey($data['attribute_key']);
            $oHash->setTitle($data['title']);
            $oHash->setType(TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_User_AttributeTypeMapper(), $data['type_id']));
            $oHash->setValueList($data['list_value']);

            try {
                $oHash->insertToDb();
                $this->_redirect('/user/viewHash');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', TM_Attribute_AttributeType::getAllInstance(new TM_User_AttributeTypeMapper()));
    }

    public function editattributehashAction()
    {
        $oHash = TM_User_Hash::getInstanceById($this->getRequest()->getParam('key'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setTitle($data['title']);
            $oHash->setType(TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_User_AttributeTypeMapper(), $data['type_id']));
            $oHash->setValueList($data['list_value']);

            try {
                $oHash->updateToDb();
                $this->_redirect('/user/viewHash');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', TM_Attribute_AttributeType::getAllInstance(new TM_User_AttributeTypeMapper()));
    }

    public function deleteattributehashAction()
    {
        $oHash = TM_User_Hash::getInstanceById($this->getRequest()->getParam('key'));
        try {
            $oHash->deleteFromDB();
            $this->_redirect('/user/viewHash');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function fillresourceAction()
    {
        $acl = new TM_Acl_Acl();
        foreach ($acl->getResources() as $resource) {
            print_r($resource);
            $res = new TM_User_Resource();
            $res->setTitle($resource);
            try {
                $res->insertToDB();

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }


}

?>