<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 26.11.11
 * Time: 14:47
 * To change this template use File | Settings | File Templates.
 */
 
class TM_User_Resource {

    /**
     * @var int
     */
    protected $_id;

    /**
     * @var string
     */
    protected $_title;

    protected $_rtitle;

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

    public function setRtitle($rtitle)
    {
        $this->_rtitle = $rtitle;
    }

    public function getRtitle()
    {
        return $this->_rtitle;
    }

    public function __get($name) {
        $method = "get{$name}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }


    /**
     * @return TM_User_Resource
     */
    public function __construct() {
        $this->_db = StdLib_DB::getInstance();
    }

    /**
     * @throws Exception
     * @return void
     */

    public function insertToDB()
    {
        try {
            $sql = 'INSERT INTO tm_user_resource(title, rtitle)
                    VALUES ("' . $this->_title . '", "' . $this->_rtitle . '")';
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
            $sql = 'UPDATE tm_user_resource
                    SET title="' . $this->_title . '", rtitle="' . $this->_rtitle . '"
                    WHERE id=' .  $this->_id ;
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
    public function deleteFromDB()
    {
        try {
            $sql = 'DELETE FROM tm_user_resource WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int $id

     * @return TM_User_Resource
     * @static
     * @access public
     */
    public static function getInstanceById($id)
    {
        try {
           $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_user_resource WHERE id=' . (int)$id;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_User_Resource();
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
            $sql = 'SELECT * FROM tm_user_resource ORDER BY title';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[$res['id']] = TM_User_Resource::getInstanceByArray($res);
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

     * @return TM_User_Resource
     * @static
     * @access public
     */
    public static function getInstanceByArray($values)
    {
        try {
            $o = new TM_User_Resource();
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function fillFromArray($values)
    {
        $this->setId($values['id']);
        $this->setTitle($values['title']);
        $this->setRtitle($values['rtitle']);
    }

}
