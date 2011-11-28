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

abstract class TM_Acl_UserAcl
{

    /**
     * @var TM_User_User
     */
    protected $_user;

    /**
     * @var mixed
     */
    protected $_object;

    /**
     * @var bool
     */
    protected $_isRead = 0;

    protected $_isWrite = 0;

    /**
     * @var StdLib_DB
     */
    protected $_db;


    /**
     * @param boolean $isAllow
     */
    public function setIsRead($isAllow)
    {
        if ($isAllow === 'on') {
            $this->_isRead = 1;
        } elseif (empty($isAllow)) {
            $this->_isRead = 0;
        } else {
            $this->_isRead = $isAllow;
        }
    }

    /**
     * @return boolean
     */
    public function getIsRead()
    {
        return $this->_isRead;
    }

    /**
     * @param boolean $isAllow
     */
    public function setIsWrite($isAllow)
    {
        if ($isAllow === 'on') {
            $this->_isWrite = 1;
        } elseif (empty($isAllow)) {
            $this->_isWrite = 0;
        } else {
            $this->_isWrite = $isAllow;
        }
    }

    /**
     * @return boolean
     */
    public function getIsWrite()
    {
        return $this->_isWrite;
    }

    /**
     * @param TM_User_User $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    /**
     * @return TM_User_User
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * @param $object
     */
    public function setObject($object)
    {
        $this->_object = $object;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->_object;
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
     * @return TM_Acl_UserAcl
     */
    public function __construct($object)
    {
        $this->_db = StdLib_DB::getInstance();
        $this->_object = $object;

        $this->_isRead = 0;
        $this->_isWrite = 0;
    }

    /**
     *
     *
     * @return void
     * @access public
     */
    abstract  public function saveToDb();

    //user_id, task_id, is_read, is_write, is_executant

    /**
     *
     * @param $object
     * @param array $values

     * @return TM_User_RoleAcl
     * @static
     * @access public
     */
    abstract public static function getInstanceByArray($object, $values);

    /**
     *
     * @param $object
     * @return array
     * @static
     * @access public
     */
    abstract public static function getAllInstance($object);

    /**
     *
     *
     * @param array $values

     * @return void
     * @access public
     */
    abstract public function fillFromArray($values);
}