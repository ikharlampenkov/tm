<?php

class IndexController extends Zend_Controller_Action
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
        $auth = Zend_Auth::getInstance();
        $data = $auth->getStorage()->read();
        if ($data->role == 'guest') {
            $this->_redirect('/login');
        }


        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParam('data');

            $oTask = TM_Task_Task::getInstanceById($data['task']);
            $oTopic = TM_Discussion_Discussion::getTopicByTask($this->_user, $oTask);

            $oDiscussion = new TM_Discussion_Discussion();
            $oDiscussion->setUser($this->_user);
            $oDiscussion->setDateCreate(date('d.m.Y H:i:s'));
            $oDiscussion->setIsMessage(true);
            $oDiscussion->setMessage($data['message']);

            $oDiscussion->setTopic($oTopic);

            if (isset($data['parent'])) {
                $oDiscussion->setParent(TM_Discussion_Discussion::getInstanceById($data['parent']));
            }

            if (isset($data['to']) && $data['to'] != '') {
                $oDiscussion->setToUser(TM_User_User::getInstanceById($data['to']));
            }

            try {
                $oDiscussion->insertToDb();
                $oDiscussion->setLinkToTask($oTask);

                $topicAcl = TM_Acl_DiscussionAcl::getAllInstance($oTopic);
                if (!empty($topicAcl)) {
                    foreach ($topicAcl as $acl) {
                        $tempAcl = new TM_Acl_DiscussionAcl($oDiscussion);
                        $tempAcl->setUser($acl->getUser());
                        $tempAcl->setIsRead($acl->getIsRead());
                        $tempAcl->setIsWrite($acl->getIsWrite());
                        $tempAcl->saveToDb();
                    }
                }

                if (!empty($data['document_title'])) {
                    $oDocument = new TM_Document_Document();
                    $oDocument->setUser($this->_user);
                    $oDocument->setDateCreate(date('d.m.Y H:i:s'));
                    $oDocument->setIsFolder(false);
                    $oDocument->setTitle($data['document_title']);
                    $oDocument->setParent(TM_Document_Document::getDocumentFolderByTask($this->_user, $oTask));

                    $oDocument->insertToDb();
                    $oDocument->setLinkToDiscussion($oDiscussion, 1);

                    if (!empty($topicAcl)) {
                        foreach ($topicAcl as $acl) {
                            $tempAcl = new TM_Acl_DocumentAcl($oDocument);
                            $tempAcl->setUser($acl->getUser());
                            $tempAcl->setIsRead($acl->getIsRead());
                            $tempAcl->setIsWrite($acl->getIsWrite());
                            $tempAcl->saveToDb();
                        }
                    }
                }

                $this->_redirect('/');
            } catch (Exception $e) {
                $this->view->assign('exception_msg', $e->getMessage());
            }
        }


        $this->view->assign('taskList', TM_Task_Task::getTaskByExecutant($this->_user));
        $this->view->assign('discussionList', TM_Discussion_Discussion::getPrivateDiscussion($this->_user));

        $this->view->assign('taskListReports', TM_Task_Task::getAllInstance($this->_user));
    }

    public function showtaskblockAction()
    {
        $this->view->assign('taskList', TM_Task_Task::getTaskByExecutant($this->_user));
    }


}

