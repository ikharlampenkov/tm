<?php

/**
 * class TM_Task_AttributeType
 * 
 */
class TM_Task_AttributeTypeMapper extends TM_Attribute_AttributeTypeMapper
{

    public function __construct() {
       parent::__construct();

    }

    /**
     *
     *

     * @return void
       @access public
     */
    public function insertToDB($type)
    {
        try {
            $sql = 'INSERT INTO tm_task_attribute_type(title, `handler`, description)
                    VALUES ("' . $type->title . '", "' . $type->handler . '", "' . $type->description  . '")';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    /**
     *
     *
     * @return void
     * @access public
     */
    public function updateToDB($type)
    {
        try {
            $sql = 'UPDATE tm_task_attribute_type
                    SET title="' . $type->title . '", `handler`="' . $type->handler . '", description="' . $type->description  . '"
                    WHERE id=' .  $type->id ;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @return
     * @access public
     */
    public function deleteFromDB($type)
    {
        try {
            $sql = 'DELETE FROM tm_task_attribute_type WHERE id=' . $type->id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int $id

     * @return Attribute::TM_Attribute_AttributeType
     * @access public
     */
    public function getInstanceById($id)
    {
        try {
           $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_task_attribute_type WHERE id=' . (int)$id;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Attribute_AttributeType($this);
                $o->fillFromArray($result[0]);
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
     * @return array
     * @access public
     */
    public function getAllInstance()
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_task_attribute_type';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Attribute_AttributeType::getInstanceByArray($this, $res);
                }
                return $retArray;
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

     * @return Attribute::TM_Attribute_Attribute
     * @access public
     */
    public function getInstanceByArray($values)
    {
        try {
            $o = new TM_Attribute_AttributeType($this);
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
} // end of TM_Task_AttributeType
?>
