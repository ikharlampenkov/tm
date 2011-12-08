<?php

class ReportsController extends Zend_Controller_Action
{

    protected $_user = null;

    public function init()
    {
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $this->_user = TM_User_User::getInstanceById($storage_data->id);
    }

    public function indexAction()
    {

    }

    public function showdesignerAction()
    {


    }

    public function generatereportAction()
    {
        $this->view->assign('taskList', TM_Task_Task::getAllInstance($this->_user));
    }


}





