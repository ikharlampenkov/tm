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
        $parentId = $this->getRequest()->getParam('parent', 0);
        $this->view->assign('taskList', TM_Task_Task::getAllInstance($this->_user, $parentId));

        if ($parentId !== 0) {
            $this->view->assign('task', TM_Task_Task::getInstanceById($parentId));
        }

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

    public function editAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oTask->setTitle($data['title']);
            $oTask->setDateCreate($data['date_create']);

            if (!empty($data['parentTask'])) {
                $oTask->addParent(TM_Task_Task::getInstanceById($data['parentTask']));
            }

            try {
                $oTask->updateToDb();
                $this->_redirect('/task');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Task_Task::getAllInstance($this->_user));
        $this->view->assign('task', $oTask);
    }

    public function deleteAction()
    {
        $oTask = TM_Task_Task::getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oTask->deleteFromDB();
            $this->_redirect('/task');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());

        }
        // action body
    }


}





