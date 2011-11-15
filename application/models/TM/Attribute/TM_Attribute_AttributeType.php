<?php

require_once 'Attribute/TM_Attribute_AttributeType.php';
require_once 'Attribute/TM_Attribute_Attribute.php';



/**
 * class TM_Attribute_AttributeType
 * 
 */
abstract class TM_Attribute_AttributeType
{

    /** Aggregations: */

    /** Compositions: */

     /*** Attributes: ***/

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
    protected $_handler;

    /**
     * 
     * @access protected
     */
    protected $_description;

    /**
     * 
     * @access protected
     */
    protected $_db;


    /**
     * 
     *
     * @return 
     * @access public
     */
    public function __construct( ) {
        $this->_db = StdLib_DB::getInstance();
    }

    /**
     * 
     *
     * @return int
     * @access public
     */
    public function getId( ) {
        return $this->_id;
    } // end of member function getId

    /**
     * 
     *
     * @return string
     * @access public
     */
    public function getTitle( ) {
        return $this->_db->prepareStringToOut($this->_title);
    } // end of member function getTitle

    /**
     * 
     *
     * @return string
     * @access public
     */
    public function getHandler( ) {
        return $this->_handler;
    } // end of member function getHandler

    /**
     * 
     *
     * @return string
     * @access public
     */
    public function getDescription( ) {
        return $this->_db->prepareStringToOut($this->_description);
    } // end of member function getDescription

    /**
     *
     *
     * @param int value

     * @return
     * @access protected
     */
    protected function setId( $value ) {
        $this->_id = (int) $this->_db->prepareString($value);
    } // end of member function setId

    /**
     * 
     *
     * @param string value 

     * @return 
     * @access public
     */
    public function setTitle( $value ) {
        $this->_title = $this->_db->prepareString($value);
    } // end of member function setTitle

    /**
     * 
     *
     * @param string value 

     * @return 
     * @access public
     */
    public function setHandler( $value ) {
        $this->_handler = $this->_db->prepareString($value);
    } // end of member function setHandler

    /**
     * 
     *
     * @param string value 

     * @return 
     * @access public
     */
    public function setDescription( $value ) {
        $this->_description = $this->_db->prepareString($value);
    } // end of member function setDescription

    /**
     * 
     *
     * @return 
     * @abstract
     * @access public
     */
    abstract public function insertToDB( );

    /**
     * 
     *
     * @return 
     * @abstract
     * @access public
     */
    abstract public function updateToDB( );

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
     * @param int id 

     * @return Attribute::TM_Attribute_AttributeType
     * @abstract
     * @static
     * @access public
     */
    abstract public static function getInstanceById( $id );

    /**
     *
     *
     * @param array values

     * @return Attribute::TM_Attribute_Attribute
     * @static
     * @access public
     */
    abstract public static function getInstanceByArray( $values );

    /**
     * 
     *
     * @return array
     * @abstract
     * @static
     * @access public
     */
    abstract public static function getAllInstance( );

    /**
     * 
     *
     * @param array values 

     * @return 
     * @access public
     */
    public function fillFromArray( $values ) {
        $this->setId($values['id']);
        $this->setTitle($values['title']);
        $this->setDescription($values['description']);
        $this->setHandler($values['handler']);
    } // end of member function fillFromArray

} // end of TM_Attribute_AttributeType
?>
