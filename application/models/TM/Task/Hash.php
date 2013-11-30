<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 19.11.11
 * Time: 14:38
 * To change this template use File | Settings | File Templates.
 */

class TM_Task_Hash extends TM_Attribute_Hash
{

    /**
     *
     * @access protected
     */
    protected $_task;

    /**
     *
     *
     * @return TM_Task_Task
     * @access public
     */
    public function getTask()
    {
        return $this->_task;
    }

    /**
     *
     *
     * @param TM_Task_Task $value
     * @return void
     * @access protected
     */
    protected function setTask(TM_Task_Task $value)
    {
        $this->_task = $value;

    }

    /**
     *
     *
     * @return TM_Task_Hash
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function insertToDb()
    {
        try {
            $sql = 'INSERT INTO tm_task_hash(task_id, attribute_key, title, type_id, list_value, list_order, required, sort_order)
                    VALUES (NULL, "' . $this->_attributeKey . '", "' . $this->_listOrder . '", "' . $this->_title . '", ' . $this->_type->getId() . ',
                            "' . $this->_listValue . ' ",  ' . $this->_prepareBool($this->_isRequired) . ', ' . $this->_sortOrder . ')';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //task_id, attribute_key, title, type_id, required, sort_order

    /**
     *
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function updateToDb()
    {
        try {
            $sql = 'UPDATE tm_task_hash
                    SET title="' . $this->_title . '", type_id=' . $this->_type->getId() . ',
                        list_value="' . $this->_listValue . ' ", list_order="' . $this->_listOrder . '",
                        required=' . $this->_prepareBool($this->_isRequired) . ', sort_order=' . $this->_sortOrder . '
                    WHERE task_id IS NULL AND attribute_key="' . $this->_attributeKey . '"';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function deleteFromDb()
    {
        try {
            $sql = 'DELETE FROM tm_task_hash
                    WHERE task_id IS NULL AND attribute_key="' . $this->_attributeKey . '"';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int $key идентификатор задачи
     * @throws Exception
     * @return TM_Task_Hash
     * @static
     * @access public
     */
    public static function getInstanceById($key)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_task_hash WHERE task_id IS NULL AND attribute_key="' . $key . '"';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Task_Hash();
                $o->fillFromArray($result[0], new TM_Task_AttributeTypeMapper());
                return $o;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param array $values
     * @throws Exception
     * @return TM_Task_Hash
     * @static
     * @access public
     */
    public static function getInstanceByArray($values)
    {
        try {
            $o = new TM_Task_Hash();
            $o->fillFromArray($values, new TM_Task_AttributeTypeMapper());
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     * @param TM_Task_Task $object
     * @throws Exception
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance($object = null)
    {
        try {
            $db = StdLib_DB::getInstance();

            /*
            if (!is_null($object)) {
                $sql = 'SELECT COUNT(attribute_key) FROM tm_task_attribute WHERE task_id=' . $object->id;
                $result = $db->query($sql, StdLib_DB::QUERY_MODE_NUM);
            }

            $sql = 'SELECT tm_task_hash.attribute_key, title, tm_task_hash.type_id, list_value, required, sort_order  FROM tm_task_hash';

            if (!is_null($object) && isset($result[0][0]) && $result[0][0] > 0) {
                $sql .= ' LEFT JOIN tm_task_attribute ON tm_task_hash.attribute_key=tm_task_attribute.attribute_key
                          WHERE tm_task_attribute.task_id=' . $object->id . ' 
                          ORDER BY required DESC, sort_order, is_fill DESC, title';
            } else {
                $sql .= ' ORDER BY required DESC, sort_order, title';
            }

            print_r($sql);
            */

            $sql = 'SELECT tm_task_hash.attribute_key, title, tm_task_hash.type_id, list_value, list_order, required, sort_order
                    FROM tm_task_hash ';

            if (!is_null($object)) {
                $sql .= ' LEFT JOIN (
                        SELECT * FROM tm_task_attribute WHERE tm_task_attribute.task_id=' . $object->getId() . '
                    ) t2 ON tm_task_hash.attribute_key=t2.attribute_key
                    ORDER BY required DESC, sort_order, title';
            } else {
                $sql .= ' ORDER BY required DESC, sort_order, title';
            }

            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Task_Hash::getInstanceByArray($res);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
