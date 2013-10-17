<?php

/**
 * class TM_Task_Task
 *
 */
class TM_Task_Task
{

    const TASK_TYPE_PERIOD = 1;

    /**
     *
     * @access protected
     */
    protected $_id = 0;

    /**
     *
     * @access protected
     */
    protected $_title;

    /**
     * @var TM_Task_Task|null
     */
    protected $_parent = null;

    /**
     * @var TM_User_User
     * @access protected
     */
    protected $_user = null;

    /**
     *
     * @access protected
     */
    protected $_dateCreate;

    /**
     * @var int
     */
    protected $_type = 1;

    /**
     * @var array - список возможный значений для типа задачи
     */
    protected $_typeList = array(1 => 'Период', 2 => 'Без учета времени', 3 => 'На дату');

    /**
     *
     * @access protected
     */
    protected $_childTask = array();

    /**
     *
     * @access protected
     */
    protected $_parentTask = array();

    /**
     * @var array
     */
    protected $_attributeList = array();

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
    public function getTitle()
    {
        return $this->_db->prepareStringToOut($this->_title);
    }

    /**
     * @return null|TM_Task_Task
     */
    public function getParent()
    {
        return $this->_parent;
    }

    /**
     *
     *
     * @return TM_User_User
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
    public function setTitle($value)
    {
        $this->_title = $this->_db->prepareString($value);
    } // end of member function setTitle

    /**
     * @param TM_Task_Task|null $value
     */
    public function setParent($value)
    {
        $this->_parent = $value;
    }

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

    /**
     * @param int $type
     */
    public function setType($type)
    {
        if (key_exists($type, $this->_typeList)) {
            $this->_type = $type;
        } else {
            $this->_type = 1;
        }

    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @return array
     */
    public function getTypeList()
    {
        return $this->_typeList;
    }

    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            throw new Exception('Can not find method ' . $method . ' in class ' . __CLASS__);
        }
    }

    /**
     * @param TM_task_Task $value
     *
     * @return string|int
     */
    protected function _prepareNull($value)
    {
        if ($value == null) {
            return 'NULL';
        } else {
            return $value->getId();
        }
    }

    /**
     *
     *
     * @return TM_Task_Task
     * @access public
     */
    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
    }

    /**
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function insertToDb()
    {
        try {
            $sql
                = 'INSERT INTO tm_task(title, user_id, parent_id, date_create, type)
                    VALUES ("' . $this->_title . '", ' . $this->_user->getId() . ', ' . $this->_prepareNull($this->_parent) . ',
                            "' . $this->_dateCreate . '", ' . $this->_type . ')';
            $this->_db->query($sql);

            $this->_id = $this->_db->getLastInsertId();
            $this->saveAttributeList();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function updateToDb()
    {
        try {
            $sql
                = 'UPDATE tm_task
                    SET title="' . $this->_title . '", parent_id=' . $this->_prepareNull($this->_parent) . ', user_id="' . $this->_user->getId() . '",
                        date_create="' . $this->_dateCreate . '", type=' . $this->_type . '
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);

            $this->saveAttributeList();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @return void
     * @access public
     */
    public function deleteFromDb()
    {
        try {
            $sql = 'DELETE FROM tm_task WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function toArchive()
    {
        try {
            $sql = 'UPDATE tm_task SET is_archive=1 WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function fromArchive()
    {
        try {
            $sql = 'UPDATE tm_task SET is_archive=0 WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int $id идентификатор задачи
     *
     * @return TM_Task_Task
     * @static
     * @access public
     */
    public static function getInstanceById($id)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_task WHERE id=' . (int)$id;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Task_Task();
                $o->fillFromArray($result[0]);
                return $o;
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
     * @param       $user
     * @param array $values
     *
     * @throws Exception
     * @return TM_Task_Task
     * @static
     * @access public
     */
    public static function getInstanceByArray($user, $values)
    {
        try {
            $o = new TM_Task_Task();
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
     * @param int $parentId
     * @param string $filter    фильтр по статусу, all - все
     * @param bool $isArchive - проект в архиве?
     *
     * @throws Exception
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance(TM_User_User $user, $parentId = 0, $filter = 'all', $isArchive = false)
    {
        try {
            $db = StdLib_DB::getInstance();

            if ($parentId > 0) {
                if ($filter == 'all') {
                    $sql = 'SELECT * FROM tm_task WHERE parent_id=' . (int)$parentId;
                } else {
                    $oHash = TM_Task_Hash::getInstanceById('state');
                    if (strpos($oHash->getValueList(true), $filter) !== false) {
                        $sql
                            = 'SELECT * FROM tm_task LEFT JOIN (
                                    SELECT * FROM tm_task_attribute WHERE attribute_key="state"
                                ) t2 ON tm_task.id=t2.task_id
                                WHERE parent_id=' . (int)$parentId . ' AND t2.attribute_value="' . $filter . '"';
                    } else {
                        $sql = 'SELECT * FROM tm_task WHERE parent_id=' . (int)$parentId;
                    }
                }
            } elseif ($parentId === -1) {
                $sql = 'SELECT * FROM tm_task';

                if ($isArchive) {
                    $sql .= ' WHERE is_archive=1';
                } else {
                    $sql .= ' WHERE is_archive=0';
                }

            } else {
                $sql
                    = 'SELECT * FROM tm_task WHERE parent_id IS NULL ';
                if ($isArchive) {
                    $sql .= ' AND is_archive=1';
                } else {
                    $sql .= ' AND is_archive=0';
                }
            }

            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Task_Task::getInstanceByArray($user, $res);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function getAllInstance

    public static function getTaskByDocument(TM_User_User $user, TM_Document_Document $document)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_task, tm_task_document WHERE tm_task.id=tm_task_document.task_id AND tm_task_document.document_id=' . $document->getId();
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Task_Task::getInstanceByArray($user, $res);
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
     * @param array $values
     *
     * @return void
     * @access public
     */
    public function fillFromArray($values)
    {
        $this->setId($values['id']);
        $this->setTitle($values['title']);
        $this->setDateCreate($values['date_create']);
        $this->setType($values['type']);

        $o_user = TM_User_User::getInstanceById($values['user_id']);
        $this->setUser($o_user);

        if ($values['parent_id'] != null) {
            $this->setParent(TM_Task_Task::getInstanceById($values['parent_id']));
        }

        $this->getAttributeList();
    }

    /**
     * Метод возвращает список потомков для данной задачи
     *
     * @throws Exception
     * @return array
     * @access public
     */
    public function getChild()
    {
        if (is_null($this->_childTask) || empty($this->_childTask)) {
            try {
                $sql = 'SELECT * FROM tm_task WHERE parent_id=' . $this->_id;
                $result = $this->_db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

                if (isset($result[0]['id'])) {
                    foreach ($result as $res) {
                        $this->_childTask[] = TM_Task_Task::getInstanceByArray($this->_user, $res);
                    }
                } else {
                    $this->_childTask = array();
                }
                return $this->_childTask;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        } else {
            return $this->_childTask;
        }
    } // end of member function getChild

    /**
     * @return bool
     */
    public function hasChild()
    {
        if (!empty($this->_childTask)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     *
     * @param TM_Task_Task $child
     *
     * @return void
     * @access public
     */
    public function addChild($child)
    {
        if ($this->_searchChild($child) === false) {
            $this->_childTask[] = $child;
        }

    } // end of member function addChild

    /**
     *
     *
     * @param TM_Task_Task $child
     *
     * @return void
     * @access public
     */
    public function deleteChild($child)
    {
        $key = $this->_searchChild($child);
        if ($key !== false) {
            unset($this->_childTask[$key]);
        }
    } // end of member function deleteChild

    protected function saveChild()
    {
        try {
            $sql = 'DELETE FROM tm_task_relation WHERE parent_id=' . $this->_id;
            $this->_db->query($sql);

            if (!is_null($this->_childTask) && !empty($this->_childTask)) {
                $sql = 'INSERT INTO tm_task_relation(parent_id, child_id) VALUES ';

                foreach ($this->_childTask as $child) {
                    $sql .= '(' . $this->_id . ', ' . $child->getId() . '), ';
                }

                $sql = substr($sql, 0, strlen($sql) - 2);
                $this->_db->query($sql);
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function _searchChild(TM_Task_Task $needle)
    {
        if (is_null($this->_childTask) && !empty($this->_childTask)) {
            return false;
        } else {
            foreach ($this->_childTask as $key => $child) {
                if ($child->_id == $needle->getId()) {
                    return $key;
                }
            }
            return false;
        }
    }

    /**
     * @return bool
     */
    public function hasParent()
    {
        if ($this->_parent !== null) {
            return true;
        } else {
            return false;
        }
    }

    public function getAttributeList()
    {
        if (is_null($this->_attributeList) || empty($this->_attributeList)) {
            try {
                $oMapper = new TM_Task_AttributeMapper();
                $attributeList = $oMapper->getAllInstance($this);
                unset($oMapper);

                if ($attributeList !== false) {
                    foreach ($attributeList as $attribute) {
                        $this->_attributeList[$attribute->attribyteKey] = $attribute;
                    }
                }

                return $this->_attributeList;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        } else {
            return $this->_attributeList;
        }
    }

    /**
     * @param $key
     *
     * @return TM_Attribute_Attribute
     */
    public function getAttribute($key)
    {
        return $this->_attributeList[$key];
    }

    public function setAttribute($key, $value)
    {
        if ($this->searchAttribute($key)) {
            $oHash = TM_Task_Hash::getInstanceById($key);

            $this->_attributeList[$key]->setValue($value);

            if ($oHash->getType() instanceof TM_Attribute_AttributeTypeList) {
                $keyO = array_search($value, $oHash->getValueList(false, true));
                $temp = $oHash->getListOrder();
                if ($key !== false && isset($temp[$keyO])) {
                    $this->_attributeList[$key]->setAttributeOrder($temp[$keyO]);
                }
            }

        } else {
            $oHash = TM_Task_Hash::getInstanceById($key);

            $oAttribute = new TM_Attribute_Attribute($this);
            $oAttribute->setAttribyteKey($key);
            $oAttribute->setType($oHash->getType());
            $oAttribute->setValue($value);

            if ($oHash->getType() instanceof TM_Attribute_AttributeTypeList) {
                $key = array_search($value, $oHash->getValueList(false, true));
                $temp = $oHash->getListOrder();
                if ($key !== false && isset($temp[$key])) {
                    $oAttribute->setAttributeOrder($temp[$key]);
                }
            }

            $this->_attributeList[$key] = $oAttribute;
            //$oAttribute->insertToDB();
        }
    }

    public function searchAttribute($needle)
    {
        if (is_null($this->_attributeList) && !empty($this->_attributeList)) {
            return false;
        } else {
            return array_key_exists($needle, $this->_attributeList);
        }
    }

    protected function saveAttributeList()
    {
        if (!is_null($this->_attributeList) && !empty($this->_attributeList)) {
            $oMapper = new TM_Task_AttributeMapper();
            foreach ($this->_attributeList as $attribute) {
                try {
                    $oMapper->insertToDB($attribute);
                } catch (Exception $e) {
                    $oMapper->updateToDB($attribute);
                }
            }
            unset($oMapper);
        }
    }

    /**
     * @param array $pathArray
     * @return array
     * @throws Exception
     */
    public function getPathToTask(&$pathArray = array())
    {
        try {
            if (!empty($this->_parentTask)) {
                $parent = $this->_parentTask[0];
                $pathArray[] = $parent;

                $parent->getPathToTask($pathArray);
            }
            return array_reverse($pathArray);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function _pathToTask(&$pathArray = array())
    {

    }

    public function getExecutant()
    {
        try {
            $taskAcl = TM_Acl_TaskAcl::getAllInstance($this);
            $userArray = array();
            if ($taskAcl) {
                foreach ($taskAcl as $acl) {
                    if ($acl->getIsExecutant()) {
                        $userArray[] = $acl->getUser();
                    }
                }
            }

            return $userArray;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function getExecuteTime()
    {
        $deadline = time();
        if ($this->searchAttribute('state') && $this->getAttribute('state')->value == 'Выполнена') {
            if ($this->searchAttribute('deadline')) {
                $deadline = strtotime($this->getAttribute('deadline')->value);
            }
        }

        $diff = $deadline - strtotime($this->_dateCreate);

        return $diff;
    }

    public function getLeftTime()
    {
        $now = time();
        $deadline = time();

        if ($this->searchAttribute('state') && trim($this->getAttribute('state')->value) == 'Выполнена') {
            $deadline = $now;
        } else {
            if ($this->searchAttribute('deadline')) {
                $deadline = strtotime($this->getAttribute('deadline')->value);
            }
        }

        $diff = $deadline - $now;
        return $diff;
    }

    public function getIsOver()
    {
        $now = time();
        $deadline = time();

        if ($this->searchAttribute('deadline')) {
            $deadline = strtotime($this->getAttribute('deadline')->value);
        }

        $diff = $deadline - $now;
        if ($diff > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getTaskStatistic()
    {
        $statArray = array('is_complite' => 0, 'is_do' => 0, 'is_out' => 0, 'is_problem' => 0, 'doc_count' => 0, 'discuss_count' => 0);
        $this->getChild();

        foreach ($this->_childTask as $child) {
            if ($child->searchAttribute('state')) {
                if (trim($child->getAttribute('state')->value) == 'Выполнена') {
                    $statArray['is_complite'] += 1;
                } elseif (trim($child->getAttribute('state')->value) == 'Возникли вопросы') {
                    $statArray['is_problem'] += 1;
                } elseif (trim($child->getAttribute('state')->value) == 'Не выполнена' && !$this->getIsOver()) {
                    $statArray['is_do'] += 1;
                } elseif (trim($child->getAttribute('state')->value) == 'Не выполнена' && $this->getIsOver()) {
                    $statArray['is_out'] += 1;
                }
            } else {
                $statArray['is_do'] += 1;
            }
        }

        $statArray['doc_count'] = TM_Document_Document::calculateCountDocumentByTask($this->_user, $this);

        $statArray['discuss_count'] = TM_Discussion_Discussion::calculateCountDiscussionByTask($this->_user, $this);

        return $statArray;
    }

    public function reCalculateDeadLine()
    {
        try {
            $sql
                = 'SELECT MAX(STR_TO_DATE( attribute_value, "%d.%m.%Y %H:%i")) as max_date, id
                    FROM tm_task
                    LEFT JOIN (
                        SELECT * FROM tm_task_attribute WHERE attribute_key="deadline"
                    )t2 ON tm_task.id = t2.task_id
                    WHERE parent_id=' . $this->_id;
            $result = $this->_db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);
            //echo $sql;

            if (isset($result[0]['max_date'])) {
                $this->setAttribute('deadline', date('d.m.Y H:i', strtotime($result[0]['max_date'])));
                $this->saveAttributeList();

                if ($this->_parent != null) {
                    $this->_parent->reCalculateDeadLine();
                }
            }
        } catch (Exception $e) {
            StdLib_Log::logMsg('Не могу пересчитать срок выполнения задачи ' . $e->getMessage(), StdLib_Log::StdLib_Log_ERROR);
            throw new Exception($e->getMessage());
        }
    }

    public function reCalculateState()
    {
        try {

            $sql
                = 'SELECT attribute_value, title
                    FROM tm_task
                    LEFT JOIN (
                        SELECT * FROM tm_task_attribute WHERE attribute_key="state"
                    )t2 ON tm_task.id = t2.task_id
                    WHERE parent_id=' . $this->_id;
            $result = $this->_db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);
            //echo $sql;

            if (isset($result[0])) {
                $is_complite = 0;
                $is_no_complite = 0;
                $newState = 'Не выполнена';
                foreach ($result as $res) {
                    if ($res['attribute_value'] == 'Выполнена') {
                        $is_complite += 1;
                    } else {
                        $is_no_complite += 1;
                    }
                }

                //echo $is_complite;
                //echo $is_no_complite;
                if ($is_no_complite == 0) {
                    $newState = 'Выполнена';
                }

                $this->setAttribute('state', $newState);
                $this->saveAttributeList();

                if ($this->_parent != null) {
                    $this->_parent->reCalculateState();
                }
            }
        } catch (Exception $e) {
            StdLib_Log::logMsg('Не могу пересчитать статус задачи ' . $e->getMessage(), StdLib_Log::StdLib_Log_ERROR);
            throw new Exception($e->getMessage());
        }

    }

    public static function getTaskByExecutant(TM_User_User $user)
    {
        try {
            $db = StdLib_DB::getInstance();

            $sql
                = 'SELECT id, title, tm_task.user_id, parent_id, date_create, type
                    FROM tm_task
                    LEFT JOIN (
                        SELECT * FROM tm_task_attribute WHERE attribute_key="deadline"
                    )t2 ON tm_task.id = t2.task_id
                    LEFT JOIN (
                        SELECT * FROM tm_task_attribute WHERE attribute_key="state"
                    ) t3 ON tm_task.id = t3.task_id
                    LEFT JOIN (
                        SELECT * FROM tm_task_attribute WHERE attribute_key="prior"
                    ) t4 ON tm_task.id = t4.task_id, tm_acl_task
                    WHERE tm_task.id=tm_acl_task.task_id
                      AND is_executant=1
                      AND tm_acl_task.user_id=' . $user->id . '
                      ORDER BY t3.attribute_value DESC, t4.attribute_order, t2.attribute_value, title';
            //echo $sql;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Task_Task::getInstanceByArray($user, $res);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function isRead(TM_User_User $user)
    {
        $aclList = TM_Acl_TaskAcl::getAllInstance($this, $user->getId());
        if ($aclList !== false) {
            if (isset($aclList[$user->getId()]) && $aclList[$user->getId()]->getIsRead()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isWrite(TM_User_User $user)
    {
        $aclList = TM_Acl_TaskAcl::getAllInstance($this, $user->getId());
        if ($aclList !== false) {
            if (isset($aclList[$user->getId()]) && $aclList[$user->getId()]->getIsWrite()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isExecutant(TM_User_User $user)
    {
        $aclList = TM_Acl_TaskAcl::getAllInstance($this, $user->getId());
        if ($aclList !== false) {
            if (isset($aclList[$user->getId()]) && $aclList[$user->getId()]->getIsExecutant()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getEstHours()
    {
        $deadline = time();
        if ($this->searchAttribute('deadline')) {
            $deadline = strtotime($this->getAttribute('deadline')->value);
        }

        $startDate = strtotime($this->_dateCreate);

        $diff = $deadline - $startDate;

        return ceil($diff / 3600);
    }

}