require_once 'Attribute/TM_Attribute_Attribute.php';
require_once 'Task/TM_Task_Task.php';
require_once 'array.php';


/**
 * class TM_Task_Attribute
 * 
 */
class TM_Task_Attribute extends TM_Attribute_Attribute
{

    /** Aggregations: */

    /** Compositions: */

     /*** Attributes: ***/


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
     * @param Task::TM_Task_Task task 

     * @param string key 

     * @return Attribute::TM_Attribute_Attribute
     * @static
     * @access public
     */
    public static function getInstanceByKey( $task,  $key ) {
    } // end of member function getInstanceByKey

    /**
     * 
     *
     * @param Task::TM_Task_Task task 

     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance( $task ) {
    } // end of member function getAllInstance





} // end of TM_Task_Attribute
?>
