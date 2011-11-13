<?php

require_once 'Attribute/TM_Attribute_Attribute.php';
require_once 'Task/TM_Task_Task.php';

//task_id, attribute_key, type_id, attribute_value


/**
 * class TM_Task_Attribute
 * 
 */
class TM_Task_Attribute extends TM_Attribute_Attribute
{

    /** Aggregations: */

    /** Compositions: */

     /*** Attributes: ***/


    public function __construct(TM_Task_Task $task) {
       parent::__construct($task);
    }

    /**
     * 
     *
     * @return 
     * @access public
     */
    public function insertToDb( ) {
        try {
            $sql = 'INSERT INTO tm_task_attribute(task_id, attribute_key, type_id, attribute_value)
                    VALUES (' . $this->_task->getId() . ', "' . $this->_attribyteKey . '", ' . $this->_type->getId() . ', "' . $this->_value  . '")';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function insertToDb

    /**
     * 
     *
     * @return 
     * @access public
     */
    public function updateToDb( ) {
         try {
            $sql = 'UPDATE tm_task_attribute
                    SET type_id="' . $this->_type->getId() . '", attribute_value="' . $this->_value . '"
                    WHERE task_id=' .  $this->_task->getId() . ' AND attribute_key="' . $this->_attribyteKey . '"';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function updateToDb

    /**
     * 
     *
     * @return 
     * @access public
     */
    public function deleteFromDb( ) {
        try {
            $sql = 'DELETE FROM tm_task_attribute
                    WHERE task_id=' .  $this->_task->getId() . ' AND attribute_key="' . $this->_attribyteKey . '"' ;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
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
    public static function getInstanceByKey(TM_Task_Task $task,  $key ) {
         try {
           $db = simo_db::getInstance();
            $sql = 'SELECT * FROM tm_task_attribute WHERE task_id=' .  $task->getId() . ' AND attribute_key="' . $key . '"' ;
            $result = $db->query($sql, simo_db::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Task_Attribute($task);
                $o->fillFromArray($result[0]);
                return $o;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function getInstanceByKey

    /**
     * 
     *
     * @param Task::TM_Task_Task task 

     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance(TM_Task_Task $task ) {
        try {
            $db = simo_db::getInstance();
            $sql = 'SELECT * FROM tm_task_attribute WHERE task_id=' .  $task->getId();
            $result = $db->query($sql, simo_db::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Task_Attribute::getInstanceByArray($res, $task);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function getAllInstance


    /**
     *
     *
     * @param array values

     * @param Task::TM_Task_Task task

     * @return Attribute::TM_Attribute_Attribute
     * @static
     * @access public
     */
    public static function getInstanceByArray($values, TM_Task_Task $task)
    {
        try {
            $o = new TM_Task_Attribute($task);
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
} // end of TM_Task_Attribute
?>
