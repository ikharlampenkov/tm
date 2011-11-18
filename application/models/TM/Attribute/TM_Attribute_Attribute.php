<?php

require_once 'Attribute/TM_Attribute_AttribyteType.php';
require_once 'Task/Task.php';
require_once 'Attribute/TM_Attribute_Attribute.php';
require_once 'array.php';
require_once 'DB.php';


/**
 * class TM_Attribute_Attribute
 * 
 */
abstract class TM_Attribute_Attribute
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
    public function getTask( ) {
        return $this->_task;
    } // end of member function getTask

    /**
     * 
     *
     * @return Attribute::TM_Attribute_AttribyteType
     * @access public
     */
    public function getType( ) {
        return $this->_type;
    } // end of member function getType

    /**
     * 
     *
     * @return string
     * @access public
     */
    public function getAttribyteKey( ) {
        return $this->_attribyteKey;
    } // end of member function getAttribyteKey

    /**
     * 
     *
     * @return string
     * @access public
     */
    public function getValue( ) {
        return $this->_db->prepareStringToOut($this->_value);
    } // end of member function getValue

    /**
     *
     *
     * @param Task::TM_Task_Task value

     * @return
     * @access protected
     */
    protected function setTask(TM_Task_Task $value ) {
        $this->_task = $value;

    } // end of member function setTask

    /**
     *
     *
     * @param string value

     * @return
     * @access protected
     */
    protected function setAttribyteKey( $value ) {
        $this->_attribyteKey = $this->_db->prepareString($value);
    } // end of member function setAttribyteKey

    /**
     *
     *
     * @param Attribute::TM_Attribute_AttribyteType value

     * @return
     * @access protected
     */
    protected function setType(TM_Attribute_AttributeType $value ) {
        $this->_type = $value;
    } // end of member function setType

    /**
     * 
     *
     * @param string value 

     * @return 
     * @access public
     */
    public function setValue( $value ) {
        $this->_value = $this->_db->prepareString($value);
    } // end of member function setValue

    /**
     * 
     *
     * @return 
     * @abstract
     * @access public
     */

    /**
     *
     *

     * @param Task::TM_Task_Task task

     * @return
     * @abstract
     * @access public
     */
    public function __construct(TM_Task_Task $task) {
        $this->_db = StdLib_DB::getInstance();

        $this->_task = $task;
    }

    abstract public function insertToDb( );

    /**
     * 
     *
     * @return 
     * @abstract
     * @access public
     */
    abstract public function updateToDb( );

    /**
     * 
     *
     * @return 
     * @abstract
     * @access public
     */
    abstract public function deleteFromDB( );

    /**
     * 
     *
     * @param Task::TM_Task_Task task 

     * @param string key 

     * @return Attribute::TM_Attribute_Attribute
     * @abstract
     * @static
     * @access public
     */
    abstract public static function getInstanceByKey( $task,  $key );

    /**
     * 
     *
     * @param array values 

     * @param Task::TM_Task_Task task 

     * @return Attribute::TM_Attribute_Attribute
     * @static
     * @access public
     */
    abstract public static function getInstanceByArray( $values,  $task );

    /**
     * 
     *
     * @param Task::TM_Task_Task task 

     * @return array
     * @abstract
     * @static
     * @access public
     */
    abstract public static function getAllInstance( $task );

    /**
     * 
     *
     * @param array values 

     * @return 
     * @access public
     */
    public function fillFromArray( $values ) {
        $o_type = TM_Task_AttributeType::getInstanceById($values['type']);
        $this->setType($o_type);

        $this->setAttribyteKey($values['attribute_key']);
        $this->setValue($values['attribute_value']);
    } // end of member function fillFromArray

} // end of TM_Attribute_Attribute
?>
