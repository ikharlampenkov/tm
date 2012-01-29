<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 29.01.12
 * Time: 22:43
 * To change this template use File | Settings | File Templates.
 */

/*
 * CREATE TABLE IF NOT EXISTS `tm_activity` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `date` datetime NOT NULL,
   `user_id` int(10) unsigned NOT NULL,
   `razdel` varchar(30) NOT NULL,
   `message` text NOT NULL,
   PRIMARY KEY (`id`),
   KEY `user_id` (`user_id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 */

class TM_Activity_Activity
{

    /**
     * @var int
     */
    protected $_id;

    /**
     * @var string
     */
    protected $_date;

    /**
     * @var TM_User_User
     */
    protected $_user;

    /**
     * @var string
     */
    protected $_razdel = '';

    /**
     * @var string
     */
    protected $_message = '';

    /**
     *
     * @var StdLib_DB
     * @access protected
     */
    protected $_db;


    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $value = $this->_db->prepareString($date);
        $this->_date = date("Y-m-d H:i:s", strtotime($value));
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->_message = $this->_db->prepareString($message);
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->_db->prepareStringToOut($this->_message);
    }

    /**
     * @param string $razdel
     */
    public function setRazdel($razdel)
    {
        $this->_razdel = $this->_db->prepareString($razdel);
    }

    /**
     * @return string
     */
    public function getRazdel()
    {
        return $this->_razdel;
    }

    /**
     * @param \TM_User_User $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    /**
     * @return \TM_User_User
     */
    public function getUser()
    {
        return $this->_user;
    }

    public function __get($name)
    {
        $method = "get{$name}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

    /**
     *
     *
     * @return TM_Activity_Activity
     * @access public
     */
    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
    }

    public function insertToDb()
    {
        try {
            $sql = 'INSERT INTO tm_activity(date_action, user_id, razdel, message)
                        VALUES ("' . $this->_date . '", ' . $this->_user->getId() . ', "' . $this->_razdel . '", "' . $this->_message . '")';
            $this->_db->query($sql);

            $this->_id = $this->_db->getLastInsertId();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function insertToDb


    //date, user_id, razdel, message

    /**
     *
     *
     * @return void
     * @access public
     */
    public function updateToDb()
    {
        try {
            $sql = 'UPDATE tm_activity
                       SET date_action="' . $this->_date . '", user_id="' . $this->_user->getId() . '",
                           razdel="' . $this->_razdel . '", message="' . $this->_message . '"
                     WHERE id=' . $this->_id;
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
    public function deleteFromDb()
    {
        try {
            $sql = 'DELETE FROM tm_activity
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int $id идентификатор задачи
     * @return TM_Activity_Activity
     * @static
     * @access public
     */
    public static function getInstanceById($id)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_activity WHERE id=' . (int)$id;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Activity_Activity();
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
     * @param array $values
     * @return TM_Activity_Activity
     * @static
     * @access public
     */
    public static function getInstanceByArray($values)
    {
        try {
            $o = new TM_Activity_Activity();
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param TM_User_User $user
     * @return array|bool
     * @static
     * @access public
     */
    public static function getAllInstance(TM_User_User $user)
    {
        try {
            $db = StdLib_DB::getInstance();

            $sql = 'SELECT * FROM tm_activity';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Activity_Activity::getInstanceByArray($res);
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
     * @return void
     * @access public
     */
    public function fillFromArray($values)
    {
        $this->setId($values['id']);
        $this->setRazdel($values['razdel']);
        $this->setDate($values['date_action']);
        $this->setMessage($values['message']);

        $o_user = TM_User_User::getInstanceById($values['user_id']);
        $this->setUser($o_user);
    }
}
