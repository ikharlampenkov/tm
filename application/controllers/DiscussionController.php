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
        $this->view->assign('parentId', $parentId);
    }

    public function addAction()
    {
        $oDiscussion = new TM_Discussion_Discussion();
        $oDiscussion->setUser($this->_user);
        $oDiscussion->setDateCreate(date('d.m.Y H:i:s'));
        $oDiscussion->setTopic(TM_Discussion_Discussion::getInstanceById($this->getRequest()->getParam('parent', 0)));
        $oDiscussion->setIsMessage(true);

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDiscussion->setMessage($data['message']);
            $oDiscussion->setDateCreate($data['date_create']);

           if (!empty($data['topic'])) {
                $oDiscussion->setTopic(TM_Discussion_Discussion::getInstanceById($data['topic']));
            }

            if (!empty($data['parent'])) {
                $oDiscussion->setParent(TM_Discussion_Discussion::getInstanceById($data['parent']));
            }

            try {
                $oDiscussion->insertToDb();
                $this->_redirect('/discussion/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Discussion_Discussion::getParentList($this->_user, $this->getRequest()->getParam('parent', 0)));
        $this->view->assign('topicList', TM_Discussion_Discussion::getAllInstance($this->_user, -1));
        $this->view->assign('discussion', $oDiscussion);
    }

    public function editAction()
    {
        $oDiscussion = TM_Discussion_Discussion::getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDiscussion->setMessage($data['message']);
            $oDiscussion->setDateCreate($data['date_create']);
            $oDiscussion->setIsMessage(true);

            if (!empty($data['topic'])) {
                $oDiscussion->setTopic(TM_Discussion_Discussion::getInstanceById($data['topic']));
            }

            if (!empty($data['parent'])) {
                $oDiscussion->setParent(TM_Discussion_Discussion::getInstanceById($data['parent']));
            }

            try {
                $oDiscussion->updateToDb();
                $this->_redirect('/discussion/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('parentList', TM_Discussion_Discussion::getParentList($this->_user, $this->getRequest()->getParam('parent', 0)));
        $this->view->assign('topicList', TM_Discussion_Discussion::getAllInstance($this->_user, -1));
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
    }

    public function addtopicAction()
    {
        $oDiscussion = new TM_Discussion_Discussion();
        $oDiscussion->setUser($this->_user);
        $oDiscussion->setDateCreate(date('d.m.Y H:i:s'));
        //$oDiscussion->setIsFirst(true);
        $oDiscussion->setIsMessage(false);

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDiscussion->setMessage($data['message']);
            $oDiscussion->setDateCreate($data['date_create']);
            //$oDiscussion->setParent(null);


            if (!empty($data['topic'])) {
                $oDiscussion->setTopic(TM_Discussion_Discussion::getInstanceById($data['topic']));
            }

            try {
                $oDiscussion->insertToDb();
                $this->_redirect('/discussion/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('topicList', TM_Discussion_Discussion::getAllInstance($this->_user, -1));
        $this->view->assign('discussion', $oDiscussion);
    }

    public function edittopicAction()
    {
        $oDiscussion = TM_Discussion_Discussion::getInstanceById($this->getRequest()->getParam('id'));

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');
            $oDiscussion->setMessage($data['message']);
            $oDiscussion->setDateCreate($data['date_create']);
            $oDiscussion->setIsMessage(false);

            if (!empty($data['topic'])) {
                $oDiscussion->setTopic(TM_Discussion_Discussion::getInstanceById($data['topic']));
            }

            try {
                $oDiscussion->updateToDb();
                $this->_redirect('/discussion/index/parent/' . $this->getRequest()->getParam('parent', 0));
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }

        }

        $this->view->assign('topicList', TM_Discussion_Discussion::getAllInstance($this->_user), -1);
        $this->view->assign('discussion', $oDiscussion);
    }

    public function deletetopicAction()
    {
        $oDiscussion = TM_Discussion_Discussion::getInstanceById($this->getRequest()->getParam('id'));
        try {
            $oDiscussion->deleteFromDB();
            $this->_redirect('/discussion/index/parent/' . $this->getRequest()->getParam('parent', 0));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());

        }
    }
}