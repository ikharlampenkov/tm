require_once 'Attribute/TM_Attribute_AttribyteType.php';
require_once 'Attribute/TM_Attribute_Attribute.php';
require_once 'array.php';
require_once 'simo_db.php';


/**
 * class TM_Attribute_AttribyteType
 * 
 */
abstract class TM_Attribute_AttribyteType
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
     * @abstract
     * @access public
     */
    abstract public function __construct( );

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
     * @return string
     * @access public
     */
    public function getHandler( ) {
    } // end of member function getHandler

    /**
     * 
     *
     * @return string
     * @access public
     */
    public function getDescription( ) {
    } // end of member function getDescription

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
     * @param string value 

     * @return 
     * @access public
     */
    public function setHandler( $value ) {
    } // end of member function setHandler

    /**
     * 
     *
     * @param string value 

     * @return 
     * @access public
     */
    public function setDescription( $value ) {
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

     * @return Attribute::TM_Attribute_AttribyteType
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
    public static function getInstanceByArray( $values ) {
    } // end of member function getInstanceByArray

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
    } // end of member function fillFromArray


    /**
     * 
     *
     * @param int value 

     * @return 
     * @access protected
     */
    protected function setId( $value ) {
    } // end of member function setId




} // end of TM_Attribute_AttribyteType
?>
