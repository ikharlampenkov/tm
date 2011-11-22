<?php

//task_id, attribute_key, type_id, attribute_value


/**
 * class TM_Task_Attribute
 *
 */
class TM_Task_AttributeMapper extends TM_Attribute_AttributeMapper
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     *
     * @param $attribute
     * @return void
    @access public
     */
    public function insertToDb($attribute)
    {
        try {
            $sql = 'INSERT INTO tm_task_attribute(task_id, attribute_key, type_id, attribute_value)
                    VALUES (' . $attribute->task->getId() . ', "' . $attribute->attribyteKey . '", ' . $attribute->type->getId() . ', "' . $attribute->value . '")';
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
    public function updateToDb($attribute)
    {
        try {
            $sql = 'UPDATE tm_task_attribute
                    SET type_id="' . $attribute->type->getId() . '", attribute_value="' . $attribute->value . '"
                    WHERE task_id=' . $attribute->task->getId() . ' AND attribute_key="' . $attribute->attribyteKey . '"';
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
    public function deleteFromDb($attribute)
    {
        try {
            $sql = 'DELETE FROM tm_task_attribute
                    WHERE task_id=' . $attribute->task->getId() . ' AND attribute_key="' . $attribute->attribyteKey . '"';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function deleteFromDb

    /**
     *
     *
     * @param Task::TM_Task_Task $task

     * @param string $key

     * @return Attribute::TM_Attribute_Attribute
     * @static
     * @access public
     */
    public function getInstanceByKey(TM_Task_Task $task, $key)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_task_attribute WHERE task_id=' . $task->getId() . ' AND attribute_key="' . $key . '"';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Attribute_Attribute($task, $this);
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
     * @param TM_Task_Task $task

     * @return array
     * @static
     * @access public
     */
    public function getAllInstance(TM_Task_Task $task)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_task_attribute WHERE task_id=' . $task->getId();
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Attribute_Attribute::getInstanceByArray($this, $task, $res);
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
     * @param TM_Task_Task $task
     * @param array $values
     *
     * @return TM_Attribute_Attribute
     * @access public
     */
    public function getInstanceByArray(TM_Task_Task $task, $values)
    {
        try {
            $o = new TM_Attribute_Attribute($this, $task);
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
} // end of TM_Task_Attribute
?>
