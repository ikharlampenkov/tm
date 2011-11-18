<?php

class TaskController extends Zend_Controller_Action
{
    protected $_user = null;

    public function init()
    {
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $this->_user = TM_User_User::getInstanceById($storage_data->id);
    }

    public function indexAction()
    {

        $this->view->assign('taskList', TM_Task_Task::getAllInstance($this->_user));
        // action body
    }

    public function addAction()
    {
        $oTask = new TM_Task_Task();
        $oTask->setUser($this->_user);
        $oTask->setDateCreate(date('d.m.Y H:i:s'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oTask->setTitle($data['title']);
            $oTask->setDateCreate($data['date_create']);

            print_r($data);

            if (!empty($data['parentTask'])) {
                $oTask->addParent(TM_Task_Task::getInstanceById($data['parentTask']));
            }

            try {
                $oTask->insertToDb();
                $this->_redirect('/task');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Task_Task::getAllInstance($this->_user));
        $this->view->assign('task', $oTask);
    }

}

