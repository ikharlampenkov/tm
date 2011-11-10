<?

/*
  CREATE  TABLE IF NOT EXISTS `status` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `prior` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `color` VARCHAR(6) NOT NULL DEFAULT 'ffffff' ,
  PRIMARY KEY (`id`) )
  ENGINE = InnoDB
 */

/**
 * class Status
 *
 */
class Status {
    /** Aggregations: */
    /** Compositions: */
    /*     * * Attributes: ** */

    /**
     *
     * @access private
     */
    private $_id;
    /**
     *
     * @access private
     */
    private $_title;
    /**
     *
     * @access private
     */
    private $_prior = 0;
    /**
     *
     * @access private
     */
    private $_color = "ffffff";
    /**
     *
     * @access private
     */
    private $_db;

    /**
     *
     *
     * @return
     * @access public
     */
    public function __construct() {
        $this->_db = simo_db::getInstance();
    }

// end of member function __constuct

    /**
     *
     *
     * @param string name

     * @return string
     * @access public
     */
    public function __get($name) {
        $method = "get{$name}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

// end of member function __get

    /**
     *
     *
     * @return int
     * @access public
     */
    public function getId() {
        return $this->_id;
    }

// end of member function getId

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getTitle() {
        return $this->_title;
    }

// end of member function getTitle

    /**
     *
     *
     * @return int
     * @access public
     */
    public function getPrior() {
        return $this->_prior;
    }

// end of member function getPrior

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getColor() {
        return $this->_color;
    }

// end of member function getColor

    /**
     *
     *
     * @param int value

     * @return
     * @access public
     */
    public function setId($value) {
        $this->_id = $value;
    }

// end of member function setId

    /**
     *
     *
     * @param string value

     * @return
     * @access public
     */
    public function setTitle($value) {
        $this->_title = $value;
    }

// end of member function setTitle

    /**
     *
     *
     * @param int value

     * @return
     * @access public
     */
    public function setPrior($value) {
        if (empty($value) || $value < 0) {
            $this->_prior = 0;
        } else {
            $this->_prior = $value;
        }
    }

// end of member function setPrior

    /**
     *
     *
     * @param string value

     * @return
     * @access public
     */
    public function setColor($value) {
        if (preg_match('/(#?)[0-9a-fA-F]{6}/', $value)>0) {
            $this->_color = $value;
        } 
    }

// end of member function setColor

    /**
     *
     *
     * @return
     * @access public
     */
    public function insertToDb() {
        try {
            $sql = 'INSERT INTO status (title, prior, color)
                    VALUES ("' . $this->_title . '", ' . $this->_prior . ', "' . $this->_color . '")';
            $this->_db->query($sql);

            $this->_id = $this->_db->getLastInsertId();
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
        }
    }

// end of member function insertToDb

    /**
     *
     *
     * @return
     * @access public
     */
    public function updateToDb() {
        try {
            $sql = 'UPDATE status
                    SET title="' . $this->_title . '", prior=' . $this->_prior . ', color="' . $this->_color . '"
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
        }
    }

// end of member function updateToDb

    /**
     *
     *
     * @return
     * @access public
     */
    public function deleteFromDb() {
        try {
            $sql = 'DELETE FROM status WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
        }
    }

// end of member function deleteFromDb

    /**
     *
     *
     * @param array array

     * @return Shop::Status
     * @static
     * @access public
     */
    public static function getInstanceByArray(array $array) {
        $o = new Status();
        $o->_assignByHash($array);
        return $o;
    }

// end of member function getInstanceByArray

    /**
     *
     *
     * @param int id

     * @return Shop::Status
     * @static
     * @access public
     */
    public static function getInstanceById($id) {
        try {
            $db = simo_db::getInstance();
            $result = $db->query('SELECT * FROM status WHERE id=' . $id, simo_db::QUERY_MOD_ASSOC);
            if (isset($result[0])) {
                $o = new Status();
                $o->_assignByHash($result[0]);
                return $o;
            }
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
            return null;
        }
    }

// end of member function getInstanceById

    /**
     *
     *
     * @return
     * @static
     * @access public
     */
    public static function getAllInstance() {
        try {
            $db = simo_db::getInstance();
            $result = $db->query('SELECT * FROM status', simo_db::QUERY_MOD_ASSOC);
            if (isset($result[0])) {
                $list = array();
                foreach ($result as $res) {
                    $o = new Status();
                    $o->_assignByHash($res);
                    $list[] = $o;
                }
                return $list;
            }
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
            return null;
        }
    }

// end of member function getAllInstance

    /**
     *
     *
     * @param array array

     * @return
     * @access private
     */
    private function _assignByHash(array $array) {
        $this->setId($array['id']);
        $this->setTitle($array['title']);
        $this->setPrior($array['prior']);
        $this->setColor($array['color']);
    }

// end of member function _assignByHash
}

// end of Status
?>