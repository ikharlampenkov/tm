<?php

require_once 'AttributeType.php';
require_once 'Attribute.php';


/**
 * class TM_Attribute_Attribute
 *
 */
class TM_Attribute_Attribute
{

    /**
     *
     * @access protected
     */
    protected $_object = null;

    /**
     *
     * @access protected
     */
    protected $_attributeKey;

    /**
     *
     * @access protected
     */
    protected $_type = null;

    /**
     *
     * @access protected
     */
    protected $_value;

    /**
     * @var int
     */
    protected $_attributeOrder = 0;

    /**
     * @var TM_Attribute_AttributeMapper
     */
    protected $_mapper = null;

    /**
     *
     * @access protected
     */
    protected $_db;


    /**
     *
     *
     * @return TM_Task_Task
     * @access public
     */
    public function getObject()
    {
        return $this->_object;
    }

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

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getValue()
    {
        return $this->_db->prepareStringToOut($this->_value);
    }

    /**
     *
     *
     * @param TM_Task_Task $value
     * @return void
     * @access protected
     */
    protected function setObject(TM_Task_Task $value)
    {
        $this->_object = $value;

    }

    /**
     *
     *
     * @param string $value
     * @return void
     * @access public
     */
    public function setAttributeKey($value)
    {
        $this->_attributeKey = $this->_db->prepareString($value);
    }

    /**
     *
     *
     * @param TM_Attribute_AttributeType $value
     * @return void
     * @access public
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
    public function setValue($value)
    {
        if ($value === 'on') {
            $this->_value = 1;
        }
        $this->_value = trim($this->_db->prepareString($value));
    }

    /**
     * @param int $attributeOrder
     */
    public function setAttributeOrder($attributeOrder)
    {
        $this->_attributeOrder = $attributeOrder;
    }

    /**
     * @return int
     */
    public function getAttributeOrder()
    {
        return $this->_attributeOrder;
    }

    /**
     *
     * @param string $name
     * @throws Exception
     * @return mixed
     * @access public
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
     * @param $object
     * @internal param \TM_Attribute_AttributeMapper $mapper
     * @return TM_Attribute_Attribute
     * @access public
     */
    public function __construct(&$object)
    {
        $this->_db = StdLib_DB::getInstance();
        $this->_object = $object;
    }

    /*
        public function insertToDB()
        {
            $this->_mapper->insertToDB($this);
        }


        /**
         *
         *
         * @return void
         * @access public
         *
        public function updateToDB()
        {
            $this->_mapper->updateToDB($this);
        }

        /**
         *
         *
         * @return void
         * @access public
         *
        public function deleteFromDB()
        {
            $this->_mapper->deleteFromDB($this);
        }

        /**
         *
         *
         * @param TM_Attribute_AttributeMapper $mapper
         * @param $object
         * @param string $key
         * @return TM_Attribute_Attribute
         * @static
         * @access public
         *
        public static function getInstanceByKey(TM_Attribute_AttributeMapper $mapper, $object, $key)
        {

            return $mapper->getInstanceByKey($object, $key);
        }

        /**
         *
         *
         * @param TM_Attribute_AttributeMapper $mapper
         * @param $object
         * @return array
         * @static
         * @access public
         *
        public static function getAllInstance(TM_Attribute_AttributeMapper $mapper, $object)
        {
            return $mapper->getAllInstance($object);
        }

        /**
         *
         *
         * @param TM_Attribute_AttributeMapper $mapper
         * @param $object
         * @param array $values
         * @return TM_Attribute_Attribute
         * @static
         * @access public
         *
        public static function getInstanceByArray(TM_Attribute_AttributeMapper $mapper, $object, $values)
        {
            return $mapper->getInstanceByArray($object, $values);
        }

        /**
         *
         *
         * @param array values
         * @return void
        @access public
         */
    public function fillFromArray($values)
    {
        $oMapper = new TM_Task_AttributeTypeMapper();
        $o_type = $oMapper->getInstanceById($values['type_id']);
        $this->setType($o_type);

        $this->setAttributeKey($values['attribute_key']);
        $this->setValue($values['attribute_value']);
        $this->setAttributeOrder($values['attribute_order']);
    }
}