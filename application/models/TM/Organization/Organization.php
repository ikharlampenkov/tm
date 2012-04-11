<?php

/**
 * class TM_Organization_Organization
 *
 */
class TM_Organization_Organization
{

    /** Aggregations: */

    /** Compositions: */

    /*** Attributes: ***/

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
    } // end of member function getTitle

    /**
     *
     *
     * @param int $value
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
     * @return void
     * @access public
     */
    public function setTitle($value)
    {
        $this->_title = $this->_db->prepareString($value);
    } // end of member function setTitle

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
     * @return TM_Organization_Organization
     * @access public
     */
    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
    } // end of member function __construct

    /**
     *
     *
     * @return void
     * @access public
     */
    public function insertToDb()
    {
        try {
            $sql = 'INSERT INTO tm_organization(title)
                    VALUES ("' . $this->_title . '")';
            $this->_db->query($sql);

            $this->_id = $this->_db->getLastInsertId();

            $this->saveAttributeList();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function insertToDb

    /**
     *
     *
     * @return void
     * @access public
     */
    public function updateToDb()
    {
        try {
            $sql = 'UPDATE tm_organization
                    SET title="' . $this->_title . '"
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);

            $this->saveAttributeList();
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
            $sql = 'DELETE FROM tm_organization
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function deleteFromDb

    /**
     *
     *
     * @param int $id идентификатор задачи
     * @return TM_Organization_Organization
     * @static
     * @access public
     */
    public static function getInstanceById($id)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_organization WHERE id=' . (int)$id;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Organization_Organization();
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
     * @param $user
     * @param array $values
     * @return TM_Organization_Organization
     * @static
     * @access public
     */
    public static function getInstanceByArray($user, $values)
    {
        try {
            $o = new TM_Organization_Organization();
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
     *
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance(TM_User_User $user)
    {
        try {
            $db = StdLib_DB::getInstance();

            $sql = 'SELECT * FROM tm_organization ';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Organization_Organization::getInstanceByArray($user, $res);
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
        $this->setId($values['id']);
        $this->setTitle($values['title']);

        $this->getAttributeList();
    } // end of member function fillFromArray

    /**
     * @return array
     * @throws Exception
     */
    public function getAttributeList()
    {
        if (is_null($this->_attributeList) || empty($this->_attributeList)) {
            try {
                $attributeList = TM_Attribute_Attribute::getAllInstance(new TM_Organization_AttributeMapper(), $this);
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
     * @return TM_Attribute_Attribute
     */
    public function getAttribute($key)
    {
        return $this->_attributeList[$key];
    }

    public function setAttribute($key, $value)
    {
        if ($this->searchAttribute($key)) {
            $oHash = TM_Organization_Hash::getInstanceById($key);

            $this->_attributeList[$key]->setValue($value);

            if ($oHash->getType() instanceof TM_Attribute_AttributeTypeList) {
                $keyO = array_search($value, $oHash->getValueList(false, true));
                $temp = $oHash->getListOrder();
                if ($key !== false && isset($temp[$keyO])) {
                    $this->_attributeList[$key]->setAttributeOrder($temp[$keyO]);
                }
            }

        } else {
            $oHash = TM_Organization_Hash::getInstanceById($key);
            $oAttribute = new TM_Attribute_Attribute(new TM_Organization_AttributeMapper(), $this);
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
            foreach ($this->_attributeList as $attribute) {
                try {
                    $attribute->insertToDB();
                } catch (Exception $e) {
                    $attribute->updateToDB();
                }
            }
        }
    }

} // end of TM_Organization_Organization
?>