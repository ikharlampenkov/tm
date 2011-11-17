<?php

/**
 * class TM_User_Role
 * 
 */
class TM_User_Role
{

    /** Aggregations: */

    /** Compositions: */

     /*** Attributes: ***/


    protected $_id;

    protected $_title;

    protected $_db;


    public function setId($id)
    {
        $this->_id = (int)$id;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setTitle($title)
    {
        $this->_title = $this->_db->prepareString($title);
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function __get($name) {
        $method = "get{$name}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }


    public function __construct() {
        $this->_db = StdLib_DB::getInstance();
    }

    public function insertToDB()
    {
        try {
            $sql = 'INSERT INTO tm_user_role(id, title)
                    VALUES (' . $this->_id . ', "' . $this->_title . '")';
            $this->_db->query($sql);
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
    public function updateToDB()
    {
        try {
            $sql = 'UPDATE tm_user_role
                    SET title="' . $this->_title . '" 
                    WHERE id=' .  $this->_id ;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @return
     * @access public
     */
    public function deleteFromDB()
    {
        try {
            $sql = 'DELETE FROM tm_user_role WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int id

     * @return User::TM_User_Role
     * @static
     * @access public
     */
    public static function getInstanceById($id)
    {
        try {
           $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_user_role WHERE id=' . (int)$id;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_User_Role();
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
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance()
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_user_role';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_User_Role::getInstanceByArray($res);
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
     * @param array values

     * @return Attribute::TM_Attribute_Attribute
     * @static
     * @access public
     */
    public static function getInstanceByArray($values)
    {
        try {
            $o = new TM_User_Role();
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function fillFromArray($values)
    {
        $this->setId($values['id']);
        $this->setTitle($values['title']);
    }

} // end of TM_User_Role
?>
