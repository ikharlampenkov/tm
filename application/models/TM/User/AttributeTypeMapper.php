<?php

/**
 * class TM_User_AttributeType
 *
 */
class TM_User_AttributeTypeMapper extends TM_Attribute_AttributeTypeMapper
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     *
     *
     * @param $type
     *
     * @throws Exception
     * @return void
    @access public
     */
    public function insertToDB($type)
    {
        try {
            $sql
                = 'INSERT INTO tm_user_attribute_type(title, `handler`, description)
                    VALUES ("' . $type->title . '", "' . $type->handler . '", "' . $type->description . '")';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    /**
     *
     *
     * @param $type
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function updateToDB($type)
    {
        try {
            $sql
                = 'UPDATE tm_user_attribute_type
                    SET title="' . $type->title . '", `handler`="' . $type->handler . '", description="' . $type->description . '"
                    WHERE id=' . $type->id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param $type
     *
     * @throws Exception
     * @return void
    @access public
     */
    public function deleteFromDB($type)
    {
        try {
            $sql = 'DELETE FROM tm_user_attribute_type WHERE id=' . $type->id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int $id
     *
     * @throws Exception
     * @return TM_Attribute_AttributeType
     * @access public
     */
    public function getInstanceById($id)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_user_attribute_type WHERE id=' . (int)$id;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $class = $result[0]['handler'];
                $o = new $class($this);
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
     * @throws Exception
     * @return array
     * @access public
     */
    public function getAllInstance()
    {
        try {
            $sql = 'SELECT * FROM tm_user_attribute_type';
            return new TM_Attribute_AttributeTypeDeferredCollection($sql, $this);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param array $values
     *
     * @throws Exception
     * @return TM_Attribute_AttributeType
     * @access public
     */
    public function getInstanceByArray($values)
    {
        try {
            $class = $values['handler'];
            $o = new $class($this);
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param int $id
     *
     * @throws Exception
     * @return bool|array
     */
    public function selectFromDB($id)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_user_attribute_type WHERE id=' . (int)$id;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                return $result[0];
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}