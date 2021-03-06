<?php

class UserController extends Zend_Controller_Action
{
    protected $_user = null;

    public function init()
    {
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $this->_user = TM_User_User::getInstanceById($storage_data->id);

        $this->_helper->AjaxContext()->addActionContext('index', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('showUserAclBlock', 'html')->initContext('html');
        $this->_helper->AjaxContext()->addActionContext('showPrivateTask', 'html')->initContext('html');
    }

    public function indexAction()
    {
        $userType = $this->getRequest()->getParam('userType', 'client');
        $organizationId = $this->getRequest()->getParam('organizationId', null);
        $organization = null;

        $organizationList = TM_Organization_Organization::getAllInstance($this->_user);

        if ($organizationId != null) {
            $organization = TM_Organization_Organization::getInstanceById($organizationId);
        }

        $this->view->assign('userRoleList', TM_User_Role::getAllInstance());
        $this->view->assign('userList', TM_User_User::getAllInstance($organization, $userType));
        //$this->view->assign('userListClient', TM_User_User::getAllInstance(1));
        $this->view->assign('userType', $userType);

        $this->view->assign('organizationList', $organizationList);
        $this->view->assign('organizationId', $organizationId);
    }

    public function viewattributetypeAction()
    {
        $oMapper = new TM_User_AttributeTypeMapper();
        $this->view->assign('attributeTypeList', $oMapper->getAllInstance());
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
        $oUser = new TM_User_User();
        $oUser->setDateCreate(date('Y-m-d'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oUser = new TM_User_User();
            $oUser->setLogin($data['login']);
            $oUser->setDateCreate($data['date_create']);
            $oUser->setPassword($data['password']);
            $oUser->setRole(TM_User_Role::getInstanceById($data['role_id']));
            $oUser->setType($data['type']);

            if ($data['organization_id'] != 'null') {
                $oUser->setOrganization(TM_Organization_Organization::getInstanceById($data['organization_id']));
            } else {
                $oUser->setOrganization(null);
            }

            foreach ($data['attribute'] as $key => $value) {
                $oUser->setAttribute($key, $value);
            }

            try {
                $oUser->insertToDb();
                $this->redirect('/user');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }
        }

        $this->view->assign('userRoleList', TM_User_Role::getAllInstance());
        $this->view->assign('attributeHashList', TM_User_Hash::getAllInstance());
        $this->view->assign('organizationList', TM_Organization_Organization::getAllInstance($this->_user));
        $this->view->assign('user', $oUser);
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
            $oUser->setType($data['type']);

            if ($data['organization_id'] != 'null') {
                $oUser->setOrganization(TM_Organization_Organization::getInstanceById($data['organization_id']));
            } else {
                $oUser->setOrganization(null);
            }

            foreach ($data['attribute'] as $key => $value) {
                $oUser->setAttribute($key, $value);
            }

            try {
                $oUser->updateToDb();
                $this->redirect('/user');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }
        }

        $this->view->assign('userRoleList', TM_User_Role::getAllInstance());
        $this->view->assign('attributeHashList', TM_User_Hash::getAllInstance($oUser));
        $this->view->assign('organizationList', TM_Organization_Organization::getAllInstance($this->_user));
        $this->view->assign('user', $oUser);
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');

        $oUser = TM_User_User::getInstanceById($id);
        $oUser->deleteFromDB();

        $this->redirect('/user');
    }

    public function addroleAction()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oRole = new TM_User_Role();
            $oRole->setTitle($data['title']);
            $oRole->setRtitle($data['rtitle']);

            $oRole->insertToDb();
            $this->redirect('/user');
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
            $this->redirect('/user');
        }

        $this->view->assign('role', TM_User_Role::getInstanceById($id));
    }

    public function deleteroleAction()
    {
        $id = $this->getRequest()->getParam('id');

        $oRole = TM_User_Role::getInstanceById($id);
        $oRole->deleteFromDB();

        $this->redirect('/user');
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

                $this->redirect('/user/showRoleAcl/idRole/' . $this->getRequest()->getParam('idRole'));
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

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            foreach ($data as $taskId => $values) {
                //print_r($values);

                try {
                    $oTask = TM_Task_Task::getInstanceById($taskId);

                    $taskAcl = new TM_Acl_TaskAcl($oTask);

                    $taskAcl->setUser($oUser);
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

                    $oFolder = TM_Document_Document::getDocumentFolderByTask($oUser, $oTask);
                    if ($oFolder != false) {
                        $folderAcl = new TM_Acl_DocumentAcl($oFolder);
                        $folderAcl->setUser($oUser);
                        if (isset($values['is_read'])) {
                            $folderAcl->setIsRead($values['is_read']);
                        } else {
                            $folderAcl->setIsRead(0);
                        }
                        if (isset($values['is_write'])) {
                            $folderAcl->setIsWrite($values['is_write']);
                        } else {
                            $folderAcl->setIsWrite(0);
                        }
                        $folderAcl->saveToDb();
                    } else {
                        StdLib_Log::logMsg('Отсутствует папка для задачи с id' . $oTask->getId() . ' и названием ' . $oTask->getTitle(), StdLib_Log::StdLib_Log_INFO);
                    }

                    $oTopic = TM_Discussion_Discussion::getTopicByTask($oUser, $oTask);
                    if ($oTopic != false) {
                        $discussionAcl = new TM_Acl_DiscussionAcl($oTopic);
                        $discussionAcl->setUser($oUser);
                        if (isset($values['is_read'])) {
                            $discussionAcl->setIsRead($values['is_read']);
                        } else {
                            $discussionAcl->setIsRead(0);
                        }
                        if (isset($values['is_write'])) {
                            $discussionAcl->setIsWrite($values['is_write']);
                        } else {
                            $discussionAcl->setIsWrite(0);
                        }
                        $discussionAcl->saveToDb();
                    } else {
                        StdLib_Log::logMsg('Отсутствует тема обсуждения для задачи с id' . $oTask->getId() . ' и названием ' . $oTask->getTitle(), StdLib_Log::StdLib_Log_INFO);
                    }

                } catch (Exception $e) {
                    StdLib_Log::logMsg('Не могу изменить права. ' . $e->getMessage(), StdLib_Log::StdLib_Log_ERROR);
                }
            }

            $this->redirect('/user/showUserAcl/id/' . $oUser->getId());
        }

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
                $this->redirect('/user/viewResource');
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
                $this->redirect('/user/viewResource');
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
            $this->redirect('/user/viewResource');
        } catch (Exception $e) {
            $this->view->assign('exception_msg', $e->getMessage());
        }
    }

    public function addattributetypeAction()
    {
        $oMapper = new TM_User_AttributeTypeMapper();
        $oType = new TM_Attribute_AttributeType();

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oMapper->insertToDb($oType);
                $this->redirect('/user/viewAttributeType');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function editattributetypeAction()
    {
        $oMapper = new TM_User_AttributeTypeMapper();
        $oType = $oMapper->getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oType->setTitle($data['title']);
            $oType->setDescription($data['description']);
            $oType->setHandler($data['handler']);

            try {
                $oMapper->updateToDb($oType);
                $this->redirect('/user/viewAttributeType');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('type', $oType);
    }

    public function deleteattributetypeAction()
    {
        $oMapper = new TM_User_AttributeTypeMapper();
        $oType = $oMapper->getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oType->deleteFromDB();
            $this->redirect('/user/viewAttributeType');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function addattributehashAction()
    {
        $oMapper = new TM_User_AttributeTypeMapper();
        $oHash = new TM_User_Hash();

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setAttributeKey($data['attribute_key']);
            $oHash->setTitle($data['title']);
            $oHash->setType($oMapper->getInstanceById($data['type_id']));
            $oHash->setValueList($data['list_value']);

            try {
                $oHash->insertToDb();
                $this->redirect('/user/viewHash');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', $oMapper->getAllInstance());
    }

    public function editattributehashAction()
    {
        $oMapper = new TM_User_AttributeTypeMapper();
        $oHash = TM_User_Hash::getInstanceById($this->getRequest()->getParam('key'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oHash->setTitle($data['title']);
            $oHash->setType($oMapper->getInstanceById($data['type_id']));
            $oHash->setValueList($data['list_value']);

            try {
                $oHash->updateToDb();
                $this->redirect('/user/viewHash');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('hash', $oHash);
        $this->view->assign('attributeTypeList', $oMapper->getAllInstance());
    }

    public function deleteattributehashAction()
    {
        $oHash = TM_User_Hash::getInstanceById($this->getRequest()->getParam('key'));
        try {
            $oHash->deleteFromDB();
            $this->redirect('/user/viewHash');
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