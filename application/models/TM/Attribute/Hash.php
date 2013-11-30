<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 19.11.11
 * Time: 14:38
 * To change this template use File | Settings | File Templates.
 */

/**
 * Class TM_Attribute_Hash базовый класс для hash атрибутов
 */
abstract class TM_Attribute_Hash
{
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
     * @var string список значений
     */
    protected $_listValue = '';

    /**
     * @var string список сортировки значений
     */
    protected $_listOrder = '';

    /**
     * @var bool обязательный к заполнению
     */
    protected $_isRequired = false;

    /**
     * @var int определяет порядок атрибутов
     */
    protected $_sortOrder = 1000;

    /**
     * @var StdLib_DB
     * @access protected
     */
    protected $_db;

    /**
     *
     *
     * @return TM_Attribute_AttributeType
     * @access public
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getAttributeKey()
    {
        return $this->_attributeKey;
    }

    public function setAttributeKey($value)
    {
        $this->_attributeKey = $this->_db->prepareString($value);
    }

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getTitle()
    {
        return $this->_db->prepareStringToOut($this->_title);
    }

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
    }

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
    }

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
    }

    /**
     *
     *
     * @param bool $asString
     * @param bool $isClear очищает от знака значения по умолчанию
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

    }

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
    }

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
     * @throws Exception
     * @return mixed
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            throw new Exception('Can not find method ' . $method . ' in class ' . __CLASS__);
        }
    }

    /**
     *
     *
     * @return \TM_Attribute_Hash
     * @access public
     */
    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
    }

    /**
     *
     *
     * @throws Exception
     * @return void
     * @access public
     */
    abstract public function insertToDb();

    /**
     *
     *
     * @throws Exception
     * @return void
     * @access public
     */
    abstract public function updateToDb();

    /**
     *
     *
     * @throws Exception
     * @return void
     * @access public
     */
    abstract public function deleteFromDb();

    /**
     *
     *
     * @param array $values
     * @param TM_Attribute_AttributeTypeMapper $typeMapper
     * @return void
     * @access public
     */
    public function fillFromArray($values, $typeMapper)
    {
        $this->setAttributeKey($values['attribute_key']);
        $this->setTitle($values['title']);
        $this->setType($typeMapper->getInstanceById($values['type_id']));
        unset($typeMapper);
        $this->setValueList($values['list_value']);
        $this->setListOrder($values['list_order']);
        $this->setIsRequired($values['required']);
        $this->setSortOrder($values['sort_order']);
    }
}
