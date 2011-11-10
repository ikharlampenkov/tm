require_once 'Attribute/TM_Attribute_AttribyteType.php';
require_once 'Task/TM_Task_Task.php';
require_once 'Attribute/TM_Attribute_Attribute.php';
require_once 'array.php';
require_once 'simo_db.php';


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
    protected $_task;

    /**
     * 
     * @access protected
     */
    protected $_attribyteKey;

    /**
     * 
     * @access protected
     */
    protected $_type;

    /**
     * 
     * @access protected
     */
    protected $value;

    /**
     * 
     * @access protected
     */
    protected $_db;


    /**
     * 
     *
     * @param Attribute::TM_Attribute_AttribyteType type 

     * @param Task::TM_Task_Task task 

     * @return 
     * @abstract
     * @access public
     */
    abstract public function __construct( $type,  $task );

    /**
     * 
     *
     * @return Task::TM_Task_Task
     * @access public
     */
    public function getTask( ) {
    } // end of member function getTask

    /**
     * 
     *
     * @return Attribute::TM_Attribute_AttribyteType
     * @access public
     */
    public function getType( ) {
    } // end of member function getType

    /**
     * 
     *
     * @return string
     * @access public
     */
    public function getAttribyteKey( ) {
    } // end of member function getAttribyteKey

    /**
     * 
     *
     * @return string
     * @access public
     */
    public function getValue( ) {
    } // end of member function getValue

    /**
     * 
     *
     * @param string value 

     * @return 
     * @access public
     */
    public function setValue( $value ) {
    } // end of member function setValue

    /**
     * 
     *
     * @return 
     * @abstract
     * @access public
     */
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
    public static function getInstanceByArray( $values,  $task ) {
    } // end of member function getInstanceByArray

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
    } // end of member function fillFromArray


    /**
     * 
     *
     * @param Task::TM_Task_Task value 

     * @return 
     * @access protected
     */
    protected function setTask( $value ) {
    } // end of member function setTask

    /**
     * 
     *
     * @param string value 

     * @return 
     * @access protected
     */
    protected function setAttribyteKey( $value ) {
    } // end of member function setAttribyteKey

    /**
     * 
     *
     * @param Attribute::TM_Attribute_AttribyteType value 

     * @return 
     * @access protected
     */
    protected function setType( $value ) {
    } // end of member function setType




} // end of TM_Attribute_Attribute
?>
