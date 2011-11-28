<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 27.11.11
 * Time: 22:04
 * To change this template use File | Settings | File Templates.
 */

/*
 * user_id,
   task_id,
   is_read,
   is_write,
   is_executant
 */

class TM_Acl_TaskAcl extends TM_Acl_UserAcl
{

    /**
     * @var bool
     */
    protected $_isExecutant = 0;

    /**
     * @var StdLib_DB
     */
    protected $_db;

    /**
     * @param boolean $isAllow
     */
    public function setIsExecutant($isAllow)
    {
        if ($isAllow == 'on') {
            $this->_isExecutant = 1;
        } elseif (empty($isAllow)) {
            $this->_isExecutant = 0;
        } else {
            $this->_isExecutant = $isAllow;
        }
    }

    /**
     * @return boolean
     */
    public function getIsExecutant()
    {
        return $this->_isExecutant;
    }

    public function __get($name)
    {
        $method = "get{$name}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

    /**
     * @param $object
     * @return TM_Acl_TaskAcl
     */
    public function __construct($object)
    {
        $this->_db = StdLib_DB::getInstance();
        $this->_object = $object;
    }

    /**
     *
     *
     * @return void
     * @access public
     */
    public function saveToDb()
    {
        try {
            $sql = 'REPLACE INTO tm_acl_task(user_id, task_id, is_read, is_write, is_executant)
                    VALUES (' . $this->_user->getId() . ', ' . $this->_object->getId() . ', ' . $this->_isRead . ', ' . $this->_isWrite . ', ' . $this->_isExecutant . ')';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //user_id, task_id, is_read, is_write, is_executant

    /**
     *
     * @param $object
     * @param array $values

     * @return TM_Acl_TaskAcl
     * @static
     * @access public
     */
    public static function getInstanceByArray($object, $values)
    {
        try {
            $o = new TM_Acl_TaskAcl($object);
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function getInstanceByArray

    /**
     *
     * @param $object
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance($object)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_acl_task WHERE task_id=' . $object->getId();
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[$res['user_id']] = TM_Acl_TaskAcl::getInstanceByArray($object, $res);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function getAllInstance

    /**
     *
     *
     * @param array $values

     * @return void
     * @access public
     */
    public function fillFromArray($values)
    {
        $this->setUser(TM_User_User::getInstanceById($values['user_id']));
        $this->setIsRead($values['is_read']);
        $this->setIsWrite($values['is_write']);
        $this->setIsExecutant($values['is_executant']);
    } // end of member function fillFromArray

}
