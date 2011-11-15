<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $o_userManager = TM_User_UserManager::getInstance();
            $o_userManager->setLogin($request->getParam('login'));
            $o_userManager->setPassword($request->getParam('psw'));


            $auth = Zend_Auth::getInstance();
            $authResult = $auth->authenticate($o_userManager);
            if ($authResult->isValid()) {
                $this->_redirect('/');
            } else {
                $this->view->assign('login_fail', true);
            }
        }
        $this->_helper->layout->disableLayout();
    }

    public function loginAction()
    {

    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/');
    }

}

