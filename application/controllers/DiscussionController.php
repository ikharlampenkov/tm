<?php

class DiscussionController extends Zend_Controller_Action
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
        $this->view->assign('discussionList', TM_Discussion_Discussion::getAllInstance($this->_user, $parentId));

        if ($parentId != 0) {
            $curDiscussion = TM_Discussion_Discussion::getInstanceById($parentId);
            
            $this->view->assign('discussion', $curDiscussion);
            $this->view->assign('breadcrumbs', $curDiscussion->getPathToDiscussion());
        }
    }

    public function addAction()
    {
        $oDiscussion = new TM_Discussion_Discussion();
        $oDiscussion->setUser($this->_user);
        $oDiscussion->setDateCreate(date('d.m.Y H:i:s'));
        $oDiscussion->setIsFolder(false);

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDiscussion->setTitle($data['title']);
            $oDiscussion->setDateCreate($data['date_create']);

            if (!empty($data['parentDiscussion'])) {
                $oDiscussion->setParent(TM_Discussion_Discussion::getInstanceById($data['parentDiscussion']));
            }

            try {
                $oDiscussion->insertToDb();
                $this->_redirect('/discussion/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Discussion_Discussion::getAllInstance($this->_user, -1, 1));
        $this->view->assign('discussion', $oDiscussion);
    }

    public function editAction()
    {
        $oDiscussion = TM_Discussion_Discussion::getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDiscussion->setTitle($data['title']);
            $oDiscussion->setDateCreate($data['date_create']);
            $oDiscussion->setIsFolder(false);

            if (!empty($data['parentDiscussion'])) {
                $oDiscussion->setParent(TM_Discussion_Discussion::getInstanceById($data['parentDiscussion']));
            }

            foreach ($data['attribute'] as $key => $value) {
                $oDiscussion->setAttribute($key, $value);
            }

            try {
                $oDiscussion->updateToDb();
                $this->_redirect('/discussion/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Discussion_Discussion::getAllInstance($this->_user, -1, 1));
        $this->view->assign('attributeHashList', TM_Discussion_Hash::getAllInstance());
        $this->view->assign('taskList', TM_Task_Task::getTaskByDiscussion($this->_user, $oDiscussion));
        $this->view->assign('discussion', $oDiscussion);
    }

    public function addfolderAction()
    {
        $oDiscussion = new TM_Discussion_Discussion();
        $oDiscussion->setUser($this->_user);
        $oDiscussion->setDateCreate(date('d.m.Y H:i:s'));
        $oDiscussion->setIsFolder(true);

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDiscussion->setTitle($data['title']);
            $oDiscussion->setDateCreate($data['date_create']);


            if (!empty($data['parentDiscussion'])) {
                $oDiscussion->setParent(TM_Discussion_Discussion::getInstanceById($data['parentDiscussion']));
            }

            try {
                $oDiscussion->insertToDb();
                $this->_redirect('/discussion/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Discussion_Discussion::getAllInstance($this->_user, -1));
        $this->view->assign('discussion', $oDiscussion);
    }

    public function editfolderAction()
    {
        $oDiscussion = TM_Discussion_Discussion::getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDiscussion->setTitle($data['title']);
            $oDiscussion->setDateCreate($data['date_create']);

            if (!empty($data['parentDiscussion'])) {
                $oDiscussion->setParent(TM_Discussion_Discussion::getInstanceById($data['parentDiscussion']));
            }

            foreach ($data['attribute'] as $key => $value) {
                $oDiscussion->setAttribute($key, $value);
            }

            try {
                $oDiscussion->updateToDb();
                $this->_redirect('/discussion/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Discussion_Discussion::getAllInstance($this->_user), -1);
        $this->view->assign('discussion', $oDiscussion);
    }

    public function deleteAction()
    {
        $oDiscussion = TM_Discussion_Discussion::getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oDiscussion->deleteFromDB();
            $this->_redirect('/discussion/index/parent/' . $this->getRequest()->getParam('parent', 0));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());

        }
        // action body
    }

}