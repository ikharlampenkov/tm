<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 22.11.11
 * Time: 15:38
 * To change this template use File | Settings | File Templates.
 */
/*
 * tm_discussion
 *
 * id,
  message,
  date_create,
  user_id,
  is_first
  topic_id
  parent_id
 */

class TM_Discussion_Discussion
{
    const ONLY_TOPIC = 1;

    const ONLY_MESSAGE = 0;


    /**
     *
     * @access protected
     */
    protected $_id;

    /**
     *
     * @access protected
     */
    protected $_message;

    /**
     *
     * @access protected
     */
    protected $_dateCreate;

    /**
     *
     * @var TM_User_User
     * @access protected
     */
    protected $_user = null;

    /**
     *
     * @var TM_User_User
     * @access protected
     */
    protected $_toUser = null;

    protected $_isFirst = false;

    protected $_isMessage = false;

    /**
     * @var bool - отметка для запроса
     */
    protected $_isRequest = false;

    /**
     * @var bool - индикатор завершенности запроса
     */
    protected $_isComplete = false;

    /**
     * @var TM_Discussion_Discussion
     * @access protected
     */
    protected $_topic = null;

    /**
     * @var TM_Discussion_Discussion
     * @access protected
     */
    protected $_parent = null;

    protected $_document = array();

    /**
     *
     * @var StdLib_DB
     * @access protected
     */
    protected $_db;


    /**
     *
     *
     * @return int
     * @access public
     */
    public function getId()
    {
        return $this->_id;
    } // end of member function getId

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getMessage()
    {
        return $this->_db->prepareStringToOut($this->_message);
    } // end of member function getTitle

    /**
     *
     *
     * @return User::TM_User_User
     * @access public
     */
    public function getUser()
    {
        return $this->_user;
    } // end of member function getUser

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getDateCreate()
    {
        return $this->_dateCreate;
    } // end of member function getDateCreate

    /**
     *
     *
     * @param int $value
     *
     * @return void
     * @access protected
     */
    protected function setId($value)
    {
        $this->_id = (int)$value;
    } // end of member function setId

    /**
     *
     *
     * @param string $value
     *
     * @return void
     * @access public
     */
    public function setMessage($value)
    {
        $this->_message = $this->_db->prepareString($value);
    } // end of member function setTitle

    /**
     *
     *
     * @param TM_User_User $value
     *
     * @return void
     * @access public
     */
    public function setUser(TM_User_User $value)
    {
        $this->_user = $value;
    } // end of member function setUser

    /**
     *
     *
     * @param string $value
     *
     * @return string
     * @access public
     */
    public function setDateCreate($value)
    {
        $value = $this->_db->prepareString($value);
        $this->_dateCreate = date("Y-m-d H:i:s", strtotime($value));
    } // end of member function setDateCreate


    public function setIsFirst($isFirst)
    {
        $this->_isFirst = $isFirst;
    }

    public function getIsFirst()
    {
        return $this->_isFirst;
    }

    public function setIsMessage($isMessage)
    {
        $this->_isMessage = $isMessage;
    }

    public function getIsMessage()
    {
        return $this->_isMessage;
    }

    /**
     * @param TM_Discussion_Discussion $topic
     */
    public function setTopic($topic)
    {
        $this->_topic = $topic;
    }

    /**
     * @return TM_Discussion_Discussion
     */
    public function getTopic()
    {
        return $this->_topic;
    }

    /**
     *
     *
     * @return TM_Discussion_Discussion
     * @access public
     */
    public function getParent()
    {
        return $this->_parent;
    } // end of member function getParent

    /**
     *
     *
     * @param TM_Discussion_Discussion $parent
     *
     * @return void
     * @access public
     */
    public function setParent(TM_Discussion_Discussion $parent)
    {
        $this->_parent = $parent;
    } // end of member function addParent

    public function isTopic()
    {
        if ($this->_isMessage) {
            return false;
        } else {
            return true;
        }
    }

    public function hasParent()
    {
        if (!is_null($this->_parent) && $this->_parent instanceof TM_Discussion_Discussion) {
            return true;
        } else {
            return false;
        }
    }

    public function setDocument($document)
    {
        $this->_document = $document;
    }

    public function getDocument()
    {
        return $this->_document;
    }

    /**
     * @param \TM_User_User $toUser
     */
    public function setToUser($toUser)
    {
        $this->_toUser = $toUser;
    }

    /**
     * @return \TM_User_User
     */
    public function getToUser()
    {
        return $this->_toUser;
    }

    /**
     * @param boolean $isComplete
     */
    public function setIsComplete($isComplete)
    {
        $this->_isComplete = $isComplete;
    }

    /**
     * @return boolean
     */
    public function getIsComplete()
    {
        return $this->_isComplete;
    }

    /**
     * @param boolean $isRequest
     */
    public function setIsRequest($isRequest)
    {
        $this->_isRequest = $isRequest;
    }

    /**
     * @return boolean
     */
    public function getIsRequest()
    {
        return $this->_isRequest;
    }

    public function __get($name)
    {
        $method = "get{$name}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

    protected function _prepareBool($value)
    {
        if ($value) {
            return 1;
        } else {
            return 0;
        }
    }

    protected function _prepareNull($value)
    {
        if (is_null($value) || empty($value)) {
            return 'NULL';
        } else {
            return $value->id;
        }

    }

    /**
     *
     *
     * @return TM_Discussion_Discussion
     * @access public
     */
    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
    }

    /**
     *
     *
     * @return void
     * @access public
     */
    public function insertToDb()
    {
        try {
            $sql
                = 'INSERT INTO tm_discussion(message, user_id, date_create, is_first, is_message, topic_id, parent_id, to_user_id, is_request, is_complete)
                    VALUES ("' . $this->_message . '", ' . $this->_user->getId() . ', "' . $this->_dateCreate . '", 
                             ' . $this->_prepareBool($this->_isFirst) . ', ' . $this->_prepareBool($this->_isMessage) . ',
                             ' . $this->_prepareNull($this->_topic) . ', ' . $this->_prepareNull($this->_parent) . ',
                             ' . $this->_prepareNull($this->_toUser) . ', ' . $this->_prepareBool($this->_isRequest) . ', ' . $this->_prepareBool($this->_isComplete) . ')';
            $this->_db->query($sql);

            $this->_id = $this->_db->getLastInsertId();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function insertToDb


    //id, message, date_create, user_id, is_first, topic_id, parent_id

    /**
     *
     *
     * @return void
     * @access public
     */
    public function updateToDb()
    {
        try {
            $sql
                = 'UPDATE tm_discussion
                    SET message="' . $this->_message . '", user_id="' . $this->_user->getId() . '", date_create="' . $this->_dateCreate . '",
                        is_first=' . $this->_prepareBool($this->_isFirst) . ', is_message=' . $this->_prepareBool($this->_isMessage) . ',
                        topic_id=' . $this->_prepareNull($this->_topic) . ', parent_id=' . $this->_prepareNull($this->_parent) . ',
                        to_user_id=' . $this->_prepareNull($this->_toUser) . ', is_request=' . $this->_prepareBool($this->_isRequest) . ',
                        is_complete=' . $this->_prepareBool($this->_isComplete) . '
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function updateToDb

    /**
     *
     *
     * @return void
     * @access public
     */
    public function deleteFromDb()
    {
        try {
            $sql
                = 'DELETE FROM tm_discussion
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function deleteFromDb

    public function toArchive()
    {
        try {
            $sql
                = 'UPDATE tm_discussion SET is_archive=1
                        WHERE id=' . $this->_id;
            $this->_db->query($sql);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function fromArchive()
    {
        try {
            $sql
                = 'UPDATE tm_discussion SET is_archive=0
                            WHERE id=' . $this->_id;
            $this->_db->query($sql);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int $id идентификатор сообщения
     *
     * @throws Exception
     * @return TM_Discussion_Discussion
     * @static
     * @access public
     */
    public static function getInstanceById($id)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_discussion WHERE id=' . (int)$id;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Discussion_Discussion();
                $o->fillFromArray($result[0]);
                return $o;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function getInstanceById

    /**
     *
     *
     * @param       $user
     * @param array $values
     *
     * @throws Exception
     * @return TM_Discussion_Discussion
     * @static
     */
    public static function getInstanceByArray($user, $values)
    {
        try {
            $o = new TM_Discussion_Discussion();
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function getInstanceByArray

    /**
     *
     *
     * @param TM_User_User $user
     * @param int $topicId id темы
     * @param int $isTopic - тема или сообщения
     * @param bool $isArchive
     *
     * @throws Exception
     * @return array
     * @static
     */
    public static function getAllInstance(TM_User_User $user, $topicId = 0, $isTopic = 1, $isArchive = false)
    {
        try {
            $db = StdLib_DB::getInstance();

            $sql = 'SELECT * FROM tm_discussion ';
            if ($topicId > 0) {
                $sql .= ' WHERE topic_id=' . (int)$topicId;
                if ($isTopic == 1) {
                    $sql .= ' AND is_message=0';
                } else {
                    $sql .= ' AND is_message=1';
                }
            } elseif ($topicId == -1) {
                if ($isArchive) {
                    $sql .= ' WHERE is_archive=1';
                } else {
                    $sql .= ' WHERE is_archive=0';
                }

            } elseif ($topicId == 0) {
                $sql = 'SELECT tm_discussion.id, message, tm_discussion.user_id, tm_discussion.date_create, tm_discussion.is_first, is_message, topic_id, tm_discussion.parent_id, to_user_id, is_request, is_complete
                        FROM tm_discussion
                          LEFT JOIN tm_task_discussion ON tm_discussion.id=tm_task_discussion.discussion_id
                          LEFT JOIN tm_task ON tm_task_discussion.task_id=tm_task.id
                        WHERE tm_discussion.topic_id IS NULL
                          AND tm_discussion.parent_id IS NULL
                          AND tm_discussion.is_message=0
                          AND tm_discussion.is_archive=' . (int)$isArchive;
                /*
                if ($isArchive) {
                    $sql .= ' AND is_archive=1';
                } else {
                    $sql .= ' AND is_archive=0';
                }
                */
            }

            if ($topicId == 0) {
                $sql .= ' ORDER BY tm_task.is_vip DESC, parent_id, tm_discussion.id';
            } else {
                $sql .= ' ORDER BY parent_id';
            }
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Discussion_Discussion::getInstanceByArray($user, $res);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Возвращает список сообщений в определенной теме в виде дерева
     *
     * @param TM_User_User $user пользователь
     * @param              $topicId тема
     *
     * @return array|bool
     * @throws Exception
     */
    public static function getDiscussionTree(TM_User_User $user, $topicId)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_discussion
                     WHERE tm_discussion.is_message=1
                       AND parent_id IS NULL
                       AND topic_id=' . (int)$topicId . '
                  ORDER BY date_create';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $temp = TM_Discussion_Discussion::getInstanceByArray($user, $res);
                    $retArray[] = $temp;
                    $temp->getChildTree($user, $temp->getId(), $retArray);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getPrivateDiscussion(TM_User_User $user)
    {
        try {
            $db = StdLib_DB::getInstance();

            $sql
                = 'SELECT * FROM tm_discussion
                    WHERE is_message=1
                      AND parent_id IS NULL
                      AND (to_user_id=' . $user->id . ' OR (user_id= ' . $user->id . ' AND to_user_id IS NOT NULL))
                    ORDER BY date_create DESC';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $temp = TM_Discussion_Discussion::getInstanceByArray($user, $res);
                    $retArray[] = $temp;
                    $temp->getChildTree($user, $temp->getId(), $retArray);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param TM_User_User $user
     * @param int $topicId
     *
     * @throws Exception
     * @return array
     * @static
     * @access public
     */
    public static function getParentList(TM_User_User $user, $topicId = 0)
    {
        try {
            $db = StdLib_DB::getInstance();

            $sql = '';
            if ($topicId > 0) {
                $sql
                    = 'SELECT * FROM tm_discussion
                        WHERE topic_id=' . (int)$topicId . ' AND is_message=1';
            } elseif ($topicId == 0) {
                $sql
                    = 'SELECT * FROM tm_discussion
                        WHERE topic_id IS NOT NULL AND is_message=1 ';
            }

            $sql .= ' ORDER BY parent_id';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Discussion_Discussion::getInstanceByArray($user, $res);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function getAllInstance

    public static function getDiscussionByTask(TM_User_User $user, TM_Task_Task $task)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT * FROM tm_discussion, tm_task_discussion
                    WHERE tm_discussion.is_message=1
                      AND tm_discussion.id=tm_task_discussion.discussion_id
                      AND tm_task_discussion.task_id=' . $task->getId() . ' ORDER BY tm_discussion.parent_id, date_create';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Discussion_Discussion::getInstanceByArray($user, $res);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Возвращает количество сообщений для задачи с учетом темы
     * @param TM_User_User $user
     * @param TM_Task_Task $task
     *
     * @return array|bool
     * @throws Exception
     */
    public static function calculateCountDiscussionByTask(TM_User_User $user, TM_Task_Task $task)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT COUNT(tm_discussion.id) AS cnt FROM tm_discussion, tm_task_discussion
                        WHERE tm_discussion.is_message=1
                          AND (tm_discussion.id=tm_task_discussion.discussion_id OR tm_discussion.topic_id=tm_task_discussion.discussion_id)
                          AND tm_task_discussion.task_id=' . $task->getId();
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0]['cnt'])) {
                return $result[0]['cnt'];
            } else {
                return 0;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getDiscussionTreeByTask(TM_User_User $user, TM_Task_Task $task)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT * FROM tm_discussion, tm_task_discussion
                    WHERE tm_discussion.is_message=1
                      AND tm_discussion.id=tm_task_discussion.discussion_id
                      AND tm_task_discussion.task_id=' . $task->getId() . '
                      AND parent_id IS NULL
                      ORDER BY date_create';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $temp = TM_Discussion_Discussion::getInstanceByArray($user, $res);
                    $retArray[] = $temp;
                    $temp->getChildTree($user, $temp->getId(), $retArray);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getTask()
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT task_id FROM tm_task_discussion
                        WHERE discussion_id=' . $this->getId();
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0]['task_id'])) {
                return TM_Task_Task::getInstanceById($result[0]['task_id']);
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getChildTree(TM_User_User $user, $parent_id, &$retArray)
    {
        try {
            $sql
                = 'SELECT * FROM tm_discussion
                    WHERE tm_discussion.is_message=1
                      AND parent_id=' . $parent_id . '
                      ORDER BY date_create';
            $result = $this->_db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);
            if (isset($result[0])) {
                foreach ($result as $res) {
                    $temp = TM_Discussion_Discussion::getInstanceByArray($user, $res);
                    $retArray[] = $temp;
                    $temp->getChildTree($user, $temp->getId(), $retArray);
                }
                //return $retArray;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    public static function getTopicByTask(TM_User_User $user, TM_Task_Task $task)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT * FROM tm_discussion, tm_task_discussion
                    WHERE tm_discussion.is_message=0
                      AND tm_discussion.id=tm_task_discussion.discussion_id
                      AND tm_task_discussion.task_id=' . $task->getId();
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                return TM_Discussion_Discussion::getInstanceByArray($user, $result[0]);
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function setLinkToTask($task)
    {
        try {
            $sql = 'INSERT INTO tm_task_discussion(task_id, discussion_id) VALUES(' . $task->id . ', ' . $this->_id . ')';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteLinkToTask($task)
    {
        try {
            $sql = 'DELETE FROM tm_task_discussion WHERE task_id=' . $task->id . ' AND discussion_id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getTopicByDocument(TM_User_User $user, TM_Document_Document $document)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT * FROM tm_discussion, tm_discussion_document
                    WHERE tm_discussion.is_message=0
                      AND tm_discussion_document.is_doc=0
                      AND tm_discussion.id=tm_discussion_document.discussion_id
                      AND tm_discussion_document.document_id=' . $document->getId();
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                return TM_Discussion_Discussion::getInstanceByArray($user, $result[0]);
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getDiscussionTreeByDocument(TM_User_User $user, TM_Document_Document $document)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT * FROM tm_discussion, tm_discussion_document
                    WHERE tm_discussion.is_message=1
                      AND tm_discussion_document.is_doc=0
                      AND tm_discussion.id=tm_discussion_document.discussion_id
                      AND tm_discussion_document.document_id=' . $document->getId() . '
                      AND parent_id IS NULL
                      ORDER BY date_create';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $temp = TM_Discussion_Discussion::getInstanceByArray($user, $res);
                    $retArray[] = $temp;
                    $temp->getChildTree($user, $temp->getId(), $retArray);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getChildTreeD(TM_User_User $user, $parent_id, &$retArray)
    {
        try {
            $sql
                = 'SELECT * FROM tm_discussion
                    WHERE tm_discussion.is_message=1
                      AND parent_id=' . $parent_id . '
                      ORDER BY date_create';
            $result = $this->_db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);
            if (isset($result[0])) {
                foreach ($result as $res) {
                    $temp = TM_Discussion_Discussion::getInstanceByArray($user, $res);
                    $retArray[] = $temp;
                    $temp->getChildTree($user, $temp->getId(), $retArray);
                }
                //return $retArray;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    public static function getDiscussionByDocument(TM_User_User $user, TM_Document_Document $document)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT * FROM tm_discussion, tm_discussion_document
                    WHERE tm_discussion.is_message=0
                      AND tm_discussion_document.is_doc=0
                      AND tm_discussion.id=tm_discussion_document.discussion_id
                      AND tm_discussion_document.document_id=' . $document->getId();
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Discussion_Discussion::getInstanceByArray($user, $res);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function setLinkToDocument($document)
    {
        try {
            $sql = 'INSERT INTO tm_discussion_document(document_id, discussion_id, is_doc) VALUES(' . $document->id . ', ' . $this->_id . ', 0)';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteLinkToDocument($document)
    {
        try {
            $sql
                = 'DELETE FROM tm_discussion_document
                    WHERE document_id=' . $document->id . ' AND discussion_id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param array $values
     *
     * @return void
     * @access public
     */
    public function fillFromArray($values)
    {
        $this->setId($values['id']);
        $this->setMessage($values['message']);
        $this->setDateCreate($values['date_create']);

        $o_user = TM_User_User::getInstanceById($values['user_id']);
        $this->setUser($o_user);

        $this->setIsFirst($values['is_first']);
        $this->setIsMessage($values['is_message']);

        $oTopic = TM_Discussion_Discussion::getInstanceById($values['topic_id']);
        if ($oTopic !== false) {
            $this->setTopic($oTopic);
        }

        $oTopic = TM_Discussion_Discussion::getInstanceById($values['parent_id']);
        if ($oTopic !== false) {
            $this->setParent($oTopic);
        }

        $oDocumentList = TM_Document_Document::getDocumentByDiscussion($o_user, $this);
        if ($oDocumentList !== false) {
            $this->setDocument($oDocumentList);
        }

        $oToUser = TM_User_User::getInstanceById($values['to_user_id']);
        if ($oToUser !== false) {
            $this->setToUser($oToUser);
        }

        $this->setIsRequest($values['is_request']);
        $this->setIsComplete($values['is_complete']);
    } // end of member function fillFromArray


    public function getPathToDiscussion(&$pathArray = array())
    {
        try {

            if (!is_null($this->_topic)) {
                $pathArray[] = $this->_topic;
                $this->_topic->getPathToDiscussion($pathArray);
            }
            return array_reverse($pathArray);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function _pathToDocument(&$pathArray = array())
    {

    }

} // end of TM_Document_Document
?>