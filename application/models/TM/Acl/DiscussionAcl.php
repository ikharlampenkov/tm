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
 */

class TM_Acl_DiscussionAcl extends TM_Acl_UserAcl
{

    /**
     * @param $object
     * @return TM_Acl_DiscussionAcl
     */
    public function __construct($object)
    {
        parent::__construct($object);
        $this->_isExecutant = 0;
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
            $sql = 'REPLACE INTO tm_acl_discussion(user_id, discussion_id, is_read, is_write)
                    VALUES (' . $this->_user->getId() . ', ' . $this->_object->getId() . ', ' . $this->_isRead . ', ' . $this->_isWrite . ')';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //user_id, task_id, is_read, is_write

    /**
     *
     * @param $object
     * @param array $values

     * @return TM_Acl_DiscussionAcl
     * @static
     * @access public
     */
    public static function getInstanceByArray($object, $values)
    {
        try {
            $o = new TM_Acl_DiscussionAcl($object);
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
            $sql = 'SELECT * FROM tm_acl_discussion WHERE discussion_id=' . $object->getId();
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[$res['user_id']] = TM_Acl_DiscussionAcl::getInstanceByArray($object, $res);
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
    } // end of member function fillFromArray

}
