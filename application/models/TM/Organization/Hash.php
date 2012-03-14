<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 19.11.11
 * Time: 14:38
 * To change this template use File | Settings | File Templates.
 */

class TM_Organization_Hash
{

    /**
     *
     * @access protected
     */
    protected $_organization;

    /**
     *
     * @access protected
     */
    protected $_attributeKey = '';

    /**
     *
     * @access protected
     */
    protected $_title;

    /**
     *
     * @var TM_Attribute_AttributeType
     * @access protected
     */
    protected $_type = null;

    /**
     * @var string
     */
    protected $_listValue = '';

    /**
     * @var string
     */
    protected $_listOrder = '';

    /**
     * @var bool
     */
    protected $_isRequired = false;

    /**
     * @var int
     */
    protected $_sortOrder = 1000;

    /**
     *
     * @access protected
     */
    protected $_db;

    /**
     *
     *
     * @return TM_Organization_Organization
     * @access public
     */
    public function getOrganization()
    {
        return $this->_organization;
    } // end of member function getOrganization

    /**
     *
     *
     * @return Attribute::TM_Attribute_AttribyteType
     * @access public
     */
    public function getType()
    {
        return $this->_type;
    } // end of member function getType

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getAttributeKey()
    {
        return $this->_attributeKey;
    } // end of member function getAttribyteKey

    public function setAttributeKey($value)
    {
        $this->_attributeKey = $this->_db->prepareString($value);
    }

    /**
     *
     *
     * @param TM_Organization_Organization $value
     * @return void
     * @access protected
     */
    protected function setOrganization(TM_Organization_Organization $value)
    {
        $this->_organization = $value;

    } // end of member function setOrganization

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
     * @param TM_Attribute_AttributeType $value
     * @return void
     * @access protected
     */
    public function setType(TM_Attribute_AttributeType $value)
    {
        $this->_type = $value;
    } // end of member function setType

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

    /**
     *
     *
     * @param array|string $value
     * @return void
     * @access public
     */
    public function setValueList($value)
    {
        if (is_array($value)) {
            $this->_listValue = $this->_db->prepareString(implode('||', $value));
        } else {
            $this->_listValue = $this->_db->prepareString(trim($value));
        }
    } // end of member function setValueList

    /**
     *
     *
     * @param bool $asString
     * @return array|string
     * @access public
     */
    public function getValueList($asString = false, $isClear = false)
    {
        if ($asString) {
            return $this->_listValue;
        } else {
            if ($isClear) {
                $temp = str_replace('*', '', $this->_listValue);
            } else {
                $temp = $this->_listValue;
            }
            return explode('||', $this->_db->prepareStringToOut($temp));
        }

    } // end of member function getValueList

    /**
     * @param string $listOrder
     */
    public function setListOrder($listOrder)
    {
        if (is_array($listOrder)) {
            $this->_listOrder = $this->_db->prepareString(implode('||', $listOrder));
        } else {
            $this->_listOrder = $this->_db->prepareString(trim($listOrder));
        }
    }

    /**
     * @param bool $asString
     * @return array|string
     * @return string
     */
    public function getListOrder($asString = false)
    {
        if ($asString) {
            return $this->_listOrder;
        } else {
            return explode('||', $this->_db->prepareStringToOut($this->_listOrder));
        }
    }


    /**
     * @param boolean $isRequired
     */
    public function setIsRequired($isRequired)
    {
        if ($isRequired === 'on') {
            $this->_isRequired = 1;
        } elseif (empty($isRequired)) {
            $this->_isRequired = 0;
        } else {
            $this->_isRequired = $isRequired;
        }
    }

    /**
     * @return boolean
     */
    public function getIsRequired()
    {
        return $this->_isRequired;
    }

    /**
     * @param int $sortOrder
     */
    public function setSortOrder($sortOrder)
    {
        $this->_sortOrder = $sortOrder;
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return $this->_sortOrder;
    } // end of member function fillFromArray

    protected function _prepareBool($value)
    {
        if ($value) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
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
     * @return TM_Organization_Hash
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
            $sql = 'INSERT INTO tm_organization_hash(organization_id, attribute_key, title, type_id, list_value, list_order, required, sort_order)
                    VALUES (NULL, "' . $this->_attributeKey . '", "' . $this->_title . '", ' . $this->_type->getId() . ',
                            "' . $this->_listValue . ' ", "' . $this->_listOrder . '",  ' . $this->_prepareBool($this->_isRequired) . ', ' . $this->_sortOrder . ')';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function insertToDb

    //organization_id, attribute_key, title, type_id, required, sort_order

    /**
     *
     *
     * @return void
     * @access public
     */
    public function updateToDb()
    {
        try {
            $sql = 'UPDATE tm_organization_hash
                    SET title="' . $this->_title . '", type_id=' . $this->_type->getId() . ',
                        list_value="' . $this->_listValue . ' ", list_order="' . $this->_listOrder . '",
                        required=' . $this->_prepareBool($this->_isRequired) . ', sort_order=' . $this->_sortOrder . '
                    WHERE organization_id IS NULL AND attribute_key="' . $this->_attributeKey . '"';
            $this->_db->query($sql);
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
            $sql = 'DELETE FROM tm_organization_hash
                    WHERE organization_id IS NULL AND attribute_key="' . $this->_attributeKey . '"';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function deleteFromDb

    /**
     *
     *
     * @param int $key идентификатор задачи
     * @return TM_Organization_Hash
     * @static
     * @access public
     */
    public static function getInstanceById($key)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_organization_hash WHERE organization_id IS NULL AND attribute_key="' . $key . '"';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Organization_Hash();
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
     * @param array $values
     * @return TM_Organization_Hash
     * @static
     * @access public
     */
    public static function getInstanceByArray($values)
    {
        try {
            $o = new TM_Organization_Hash();
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
    public static function getAllInstance($object = null)
    {
        try {
            $db = StdLib_DB::getInstance();

            $sql = 'SELECT tm_organization_hash.attribute_key, title, tm_organization_hash.type_id, list_value, list_order, required, sort_order
                    FROM tm_organization_hash ';

            if (!is_null($object)) {
                $sql .= ' LEFT JOIN (
                        SELECT * FROM tm_organization_attribute WHERE tm_organization_attribute.organization_id=' . $object->id . '
                    ) t2 ON tm_organization_hash.attribute_key=t2.attribute_key
                    ORDER BY required DESC, sort_order, title';
            } else {
                $sql .= ' ORDER BY required DESC, sort_order, title';
            }

            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Organization_Hash::getInstanceByArray($res);
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
        //$this->setOrganization($values['organization_id']);
        $this->setAttributeKey($values['attribute_key']);
        $this->setTitle($values['title']);

        $this->setType(TM_Attribute_AttributeTypeFactory::getAttributeTypeById(new TM_Organization_AttributeTypeMapper(), $values['type_id']));
        $this->setValueList($values['list_value']);
        $this->setListOrder($values['list_order']);
        $this->setIsRequired($values['required']);
        $this->setSortOrder($values['sort_order']);
    }
}
