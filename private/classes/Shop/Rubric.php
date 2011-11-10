<?php

/**
 * class Rubric
 *
 */
class Rubric {
    /** Aggregations: */
    /** Compositions: */
    /*     * * Attributes: ** */

    const IS_ROOT = 1;
    const IS_NOT_ROOT = 0;

    /**
     *
     * @access protected
     */
    protected $_id;
    /**
     *
     * @access protected
     */
    protected $_title;
    /**
     *
     * @access protected
     */
    protected $_parent;
    /**
     *
     * @access protected
     */
    protected $_isRoot = 0;
    private $_db;

    /**
     *
     *
     * @param int id

     * @param string name

     * @param int parent

     * @return
     * @access public
     */
    public function __construct($id = 0, $title = '', $parent = 0) {
        $this->_db = simo_db::getInstance();

        $this->_id = $id;
        $this->_title = $title;
        $this->_parent = $parent;
    }

// end of member function __construct

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

// end of member function getName

    /**
     *
     *
     * @return int
     * @access public
     */
    public function getParent() {
        return $this->_parent;
    }

// end of member function getParent

    /**
     *
     *
     * @return bool
     * @access public
     */
    public function getIsRoot() {
        return $this->_isRoot;
    }

// end of member function getIsRoot

    public function __get($name) {
        $method = "get{$name}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

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

// end of member function setName

    /**
     *
     *
     * @param int value

     * @return int
     * @access public
     */
    public function setParent($value) {
        $this->_parent = $value;
    }

// end of member function setParent

    /**
     *
     *
     * @param bool value

     * @return
     * @access public
     */
    public function setIsRoot($value) {
        $this->_isRoot = $value;
    }

// end of member function setIsRoot

    public function insertToDb() {
        try {
            $sql = 'INSERT INTO product_rubric (title, parent_id, is_root)
                    VALUES ("' . $this->_title . '", ' . $this->_parent . ', ' . Rubric::IS_NOT_ROOT . ')';
            $this->_db->query($sql);
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
            return null;
        }
    }

    public function updateToDb() {
        try {
            $sql = 'UPDATE product_rubric
                    SET title="' . $this->_title . '", parent_id="' . $this->_parent . '", is_root=' . Rubric::IS_NOT_ROOT . '
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
            return null;
        }
    }

    public function deleteFromDb() {
        try {
            $tempPC = new ProductCatalog();
            $tempPL = $tempPC->getAllProduct($this->_id);
            if ($tempPL !== false) {
                foreach ($tempPL as $product) {
                    $product->deleteFromDb();
                }
            }

            $sql = 'DELETE FROM product_rubric WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
        }
    }

    public function getPathToRubric(&$path = array()) {
        if ($this->_isRoot != Rubric::IS_ROOT) {
            $tempRubric = Rubric::getInstanceById($this->_parent);
            if ($tempRubric instanceof Rubric) {
                $path[] = $tempRubric;
                if ($tempRubric->getIsRoot() != Rubric::IS_ROOT) {
                    $tempRubric->getPathToRubric($path);
                }
            } else {
                return false;
            }
            return array_reverse($path);
        } else
            return false;
    }

    public static function getInstanceById($id) {
        try {
            $db = simo_db::getInstance();
            $result = $db->query('SELECT * FROM product_rubric WHERE id=' . $id, simo_db::QUERY_MOD_ASSOC);
            if (isset($result[0]) && !empty($result[0])) {
                $o = new Rubric();
                $o->assignByHash($result[0]);
                return $o;
            } else
                return false;
        } catch (Exception $e) {
            simo_exception::registrMsg($e, true);
            return false;
        }
    }

    public static function getInstanceByArray(array $array) {
        $o = new Rubric();
        $o->assignByHash($array);
        return $o;
    }

    public static function getRootRubric() {
        try {
            $db = simo_db::getInstance();
            $result = $db->query('SELECT * FROM product_rubric WHERE is_root=' . Rubric::IS_ROOT, simo_db::QUERY_MOD_ASSOC);
            if (isset($result[0])) {
                $o = new Rubric();
                $o->assignByHash($result[0]);
                return $o;
            }
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
            return null;
        }
    }

    protected function assignByHash($result) {
        $this->setId($result['id']);
        $this->setTitle($result['title']);
        $this->setParent($result['parent_id']);
        $this->setIsRoot($result['is_root']);
    }

}

// end of Rubric
?>