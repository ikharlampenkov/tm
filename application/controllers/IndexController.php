<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $auth = Zend_Auth::getInstance();
        $data = $auth->getStorage()->read();
        if ($data->role == 'guest') {
            $this->_redirect('/login');
        }
    }


}

