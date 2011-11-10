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
     * @access public
     */
    public function insertToDB( ) {
    } // end of member function insertToDB

    /**
     * 
     *
     * @return 
     * @access public
     */
    public function updateToDB( ) {
    } // end of member function updateToDB

    /**
     * 
     *
     * @return 
     * @access public
     */
    public function deleteFromDB( ) {
    } // end of member function deleteFromDB

    /**
     * 
     *
     * @param int id 

     * @return Attribute::TM_Attribute_AttribyteType
     * @static
     * @access public
     */
    public static function getInstanceById( $id ) {
    } // end of member function getInstanceById

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
     * @static
     * @access public
     */
    public static function getAllInstance( ) {
    } // end of member function getAllInstance

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
