<?php

class ReportsController extends Zend_Controller_Action
{

    protected $_user = null;

    public function init()
    {
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $this->_user = TM_User_User::getInstanceById($storage_data->id);

        $this->_helper->AjaxContext()->addActionContext('showTaskBlock', 'html')->initContext('html');
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

    public function showtaskblockAction()
    {
        $parentId = $this->getRequest()->getParam('parent', 0);
        $this->view->assign('taskList', TM_Task_Task::getAllInstance($this->_user, $parentId));
    }


}





