<?php

class UserController extends Zend_Controller_Action
{

    protected $oUser;

    public function init()
    {
        $this->oUser = new TM_User_User();
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->assign('userRoleList', TM_User_Role::getAllInstance());
        $this->view->assign('userList', TM_User_User::getAllInstance());
    }


}