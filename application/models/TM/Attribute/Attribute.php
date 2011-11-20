<?php

require_once 'AttributeType.php';
require_once 'Attribute.php';


/**
 * class TM_Attribute_Attribute
 *
 */
class TM_Attribute_Attribute
{

    /** Aggregations: */

    /** Compositions: */

    /*** Attributes: ***/

    /**
     *
     * @access protected
     */
    protected $_task = null;

    /**
     *
     * @access protected
     */
    protected $_attribyteKey;

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
     * @return Task::TM_Task_Task
     * @access public
     */
    public function getTask()
    {
        return $this->_task;
    } // end of member function getTask

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
    public function getAttribyteKey()
    {
        return $this->_attribyteKey;
    } // end of member function getAttribyteKey

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getValue()
    {
        return $this->_db->prepareStringToOut($this->_value);
    } // end of member function getValue

    /**
     *
     *
     * @param Task::TM_Task_Task value

     * @return
     * @access protected
     */
    protected function setTask(TM_Task_Task $value)
    {
        $this->_task = $value;

    } // end of member function setTask

    /**
     *
     *
     * @param string $value

     * @return void
     * @access public
     */
    public function setAttribyteKey($value)
    {
        $this->_attribyteKey = $this->_db->prepareString($value);
    } // end of member function setAttribyteKey

    /**
     *
     *
     * @param Attribute::TM_Attribute_AttribyteType $value

     * @return void
     * @access public
     */
    public function setType(TM_Attribute_AttributeType $value)
    {
        $this->_type = $value;
    } // end of member function setType

    /**
     *
     *
     * @param string value

     * @return
     * @access public
     */
    public function setValue($value)
    {
        $this->_value = $this->_db->prepareString($value);
    } // end of member function setValue

    /**
     *
     *
     * @return
     * @abstract
     * @access public
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
     * @param TM_Attribute_AttributeMapper $mapper
     * @param TM_Task_Task $task
     * @return TM_Attribute_Attribute
     * @access public
     */
    public function __construct(TM_Attribute_AttributeMapper $mapper, TM_Task_Task $task)
    {
        $this->_mapper = $mapper;
        $this->_db = StdLib_DB::getInstance();
        $this->_task = $task;
    }

    public function insertToDB()
    {
        $this->_mapper->insertToDB($this);
    }


    /**
     *
     *
     * @return void
     * @access public
     */
    public function updateToDB()
    {
        $this->_mapper->updateToDB($this);
    }

    /**
     *
     *
     * @return void
     * @access public
     */
    public function deleteFromDB()
    {
        $this->_mapper->deleteFromDB($this);
    }

    /**
     *
     *
     * @param TM_Attribute_AttributeMapper $mapper
     * @param TM_Task_Task $task
     * @param string $key
     * @return TM_Attribute_Attribute
     * @static
     * @access public
     */
    public static function getInstanceByKey(TM_Attribute_AttributeMapper $mapper, $task, $key)
    {

        return $mapper->getInstanceByKey($task, $key);
    }

    /**
     *
     *
     * @param TM_Attribute_AttributeMapper $mapper
     * @param TM_Task_Task $task
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance(TM_Attribute_AttributeMapper $mapper, TM_Task_Task $task)
    {
        return $mapper->getAllInstance($task);
    }

    /**
     *
     *
     * @param TM_Attribute_AttributeMapper $mapper
     * @param TM_Task_Task $task
     * @param array $values
     * @return TM_Attribute_Attribute
     * @static
     * @access public
     */
    public static function getInstanceByArray(TM_Attribute_AttributeMapper $mapper, TM_Task_Task $task, $values)
    {
        return $mapper->getInstanceByArray($task, $values);
    }

    /**
     *
     *
     * @param array values

     * @return
     * @access public
     */
    public function fillFromArray($values)
    {
        $o_type = TM_Attribute_AttributeType::getInstanceById(new TM_Task_AttributeTypeMapper(), $values['type_id']);
        $this->setType($o_type);

        $this->setAttribyteKey($values['attribute_key']);
        $this->setValue($values['attribute_value']);
    } // end of member function fillFromArray

} // end of TM_Attribute_Attribute
?>
