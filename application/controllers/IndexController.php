<?php

class IndexController extends Zend_Controller_Action
{

    protected $_user = null;

    public function init()
    {
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $this->_user = TM_User_User::getInstanceById($storage_data->id);
    }

    public function indexAction()
    {
        $auth = Zend_Auth::getInstance();
        $data = $auth->getStorage()->read();
        if ($data->role == 'guest') {
            $this->_redirect('/login');
        }


        $this->view->assign('taskList', TM_Task_Task::getTaskByExecutant($this->_user));
        $this->view->assign('discussionList', TM_Discussion_Discussion::getPrivateDiscussion($this->_user));
    }


}

