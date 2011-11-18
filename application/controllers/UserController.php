<?php

class UserController extends Zend_Controller_Action
{


    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->assign('userRoleList', TM_User_Role::getAllInstance());
        $this->view->assign('userList', TM_User_User::getAllInstance());
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

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oUser = TM_User_User::getInstanceById($id);
            $oUser->setLogin($data['login']);
            $oUser->setDateCreate($data['date_create']);
            $oUser->setPassword($data['password']);
            $oUser->setRole(TM_User_Role::getInstanceById($data['role_id']));

            $oUser->updateToDb();
            $this->_redirect('/user');
        }

        $this->view->assign('userRoleList', TM_User_Role::getAllInstance());
        $this->view->assign('user', TM_User_User::getInstanceById($id));
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

}