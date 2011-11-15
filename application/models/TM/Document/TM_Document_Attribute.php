<?php

require_once 'Attribute/TM_Attribute_AttribyteType.php';
require_once 'Attribute/TM_Attribute_Attribute.php';


/**
 * class TM_Document_Attribute
 * 
 */
class TM_Document_Attribute extends TM_Attribute_Attribute
{

    /** Aggregations: */

    /** Compositions: */

     /*** Attributes: ***/


    public function insertToDb()
    {
        // TODO: Implement insertToDb() method.
    }

    /**
     *
     *
     * @return
     * @access public
     */
    public function updateToDb()
    {
        // TODO: Implement updateToDb() method.
    }

    /**
     *
     *
     * @return
     * @access public
     */
    public function deleteFromDB()
    {
        // TODO: Implement deleteFromDB() method.
    }

    /**
     *
     *
     * @param Task::TM_Task_Task task

     * @param string key

     * @return Attribute::TM_Attribute_Attribute
     * @static
     * @access public
     */
    public static function getInstanceByKey($task, $key)
    {
        // TODO: Implement getInstanceByKey() method.
    }

    /**
     *
     *
     * @param array values

     * @param Task::TM_Task_Task task

     * @return Attribute::TM_Attribute_Attribute
     * @static
     * @access public
     */
    public static function getInstanceByArray($values, $task)
    {
        // TODO: Implement getInstanceByArray() method.
    }

    /**
     *
     *
     * @param Task::TM_Task_Task task

     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance($task)
    {
        // TODO: Implement getAllInstance() method.
    }
} // end of TM_Document_Attribute
?>
