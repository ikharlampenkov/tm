<?php

require_once 'User/TM_User_User.php';
require_once 'Task/TM_Task_Task.php';
require_once 'array.php';
require_once 'simo_db.php';


/**
 * class TM_Task_Task
 * 
 */
class TM_Task_Task
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
    protected $_user;

    /**
     * 
     * @access protected
     */
    protected $_dateCreate;

    /**
     * 
     * @access protected
     */
    protected $_childTask;

    /**
     * 
     * @access protected
     */
    protected $_parentTask;

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
    } // end of member function __construct

    /**
     * 
     *
     * @return int
     * @access public
     */
    public function getId( ) {
    } // end of member function getId

    /**
     * 
     *
     * @return string
     * @access public
     */
    public function getTitle( ) {
    } // end of member function getTitle

    /**
     * 
     *
     * @return User::TM_User_User
     * @access public
     */
    public function getUser( ) {
    } // end of member function getUser

    /**
     * 
     *
     * @return string
     * @access public
     */
    public function getDateCreate( ) {
    } // end of member function getDateCreate

    /**
     * 
     *
     * @param string value 

     * @return 
     * @access public
     */
    public function setTitle( $value ) {
    } // end of member function setTitle

    /**
     * 
     *
     * @param User::TM_User_User value 

     * @return 
     * @access public
     */
    public function setUser( $value ) {
    } // end of member function setUser

    /**
     * 
     *
     * @param string value 

     * @return string
     * @access public
     */
    public function setDateCreate( $value ) {
    } // end of member function setDateCreate

    /**
     * 
     *
     * @return 
     * @access public
     */
    public function insertToDb( ) {
    } // end of member function insertToDb

    /**
     * 
     *
     * @return 
     * @access public
     */
    public function updateToDb( ) {
    } // end of member function updateToDb

    /**
     * 
     *
     * @return 
     * @access public
     */
    public function deleteFromDb( ) {
    } // end of member function deleteFromDb

    /**
     * 
     *
     * @param int id 

     * @return Task::TM_Task_Task
     * @static
     * @access public
     */
    public static function getInstanceById( $id ) {
    } // end of member function getInstanceById

    /**
     * 
     *
     * @param array values 

     * @return Task::TM_Task_Task
     * @static
     * @access public
     */
    public static function getInstanceByArray( $values ) {
    } // end of member function getInstanceByArray

    /**
     * 
     *
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance( ) {
    } // end of member function getAllInstance

    /**
     * 
     *
     * @return array
     * @access public
     */
    public function getChild( ) {
    } // end of member function getChild

    /**
     * 
     *
     * @param Task::TM_Task_Task child 

     * @return 
     * @access public
     */
    public function addChild( $child ) {
    } // end of member function addChild

    /**
     * 
     *
     * @param Task::TM_Task_Task child 

     * @return 
     * @access public
     */
    public function deleteChild( $child ) {
    } // end of member function deleteChild

    /**
     * 
     *
     * @return array
     * @access public
     */
    public function getParent( ) {
    } // end of member function getParent

    /**
     * 
     *
     * @param Task::TM_Task_Task parent 

     * @return 
     * @access public
     */
    public function addParent( $parent ) {
    } // end of member function addParent

    /**
     * 
     *
     * @param Task::TM_Task_Task parent 

     * @return 
     * @access public
     */
    public function deleteParent( $parent ) {
    } // end of member function deleteParent


    /**
     * 
     *
     * @param int value 

     * @return 
     * @access protected
     */
    protected function setId( $value ) {
    } // end of member function setId




} // end of TM_Task_Task
?>
