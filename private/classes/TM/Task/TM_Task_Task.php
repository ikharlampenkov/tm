require_once 'Task/TM_Task_Task.php';
require_once 'array.php';
require_once 'User/TM_User_User.php';
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





} // end of TM_Task_Task
?>
