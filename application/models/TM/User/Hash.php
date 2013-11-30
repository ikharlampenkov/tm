<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 19.11.11
 * Time: 14:38
 * To change this template use File | Settings | File Templates.
 */

class TM_User_Hash extends TM_Attribute_Hash
{

    /**
     * @var TM_User_User
     * @access protected
     */
    protected $_user;

    /**
     *
     *
     * @return TM_User_User
     * @access public
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     *
     *
     * @param TM_User_User $value value
     *
     * @return void
     */
    protected function setUser(TM_User_User $value)
    {
        $this->_user = $value;

    }

    /**
     *
     *
     * @return TM_User_Hash
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
            $sql
                = 'INSERT INTO tm_user_hash(user_id, attribute_key, title, type_id, list_value, list_order, required, sort_order)
                    VALUES (NULL, "' . $this->_attributeKey . '", "' . $this->_title . '", ' . $this->_type->getId() . ',
                            "' . $this->_listValue . ' ", "' . $this->_listOrder . '",  ' . $this->_prepareBool($this->_isRequired) . ', ' . $this->_sortOrder . ')';
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
    public function updateToDb()
    {
        try {
            $sql
                = 'UPDATE tm_user_hash
                    SET title="' . $this->_title . '", type_id=' . $this->_type->getId() . ',
                        list_value="' . $this->_listValue . ' ", list_order="' . $this->_listOrder . '",
                        required=' . $this->_prepareBool($this->_isRequired) . ', sort_order=' . $this->_sortOrder . '
                    WHERE user_id IS NULL AND attribute_key="' . $this->_attributeKey . '"';
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
            $sql
                = 'DELETE FROM tm_user_hash
                    WHERE user_id IS NULL AND attribute_key="' . $this->_attributeKey . '"';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int $key идентификатор задачи
     *
     * @throws Exception
     * @return TM_User_Hash
     * @static
     * @access public
     */
    public static function getInstanceById($key)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_user_hash WHERE user_id IS NULL AND attribute_key="' . $key . '"';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_User_Hash();
                $o->fillFromArray($result[0], new TM_User_AttributeTypeMapper());
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
     *
     * @throws Exception
     * @return TM_User_Hash
     * @static
     * @access public
     */
    public static function getInstanceByArray($values)
    {
        try {
            $o = new TM_User_Hash();
            $o->fillFromArray($values, new TM_User_AttributeTypeMapper());
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     * @param TM_User_User $object
     *
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
                $sql = 'SELECT COUNT(attribute_key) FROM tm_user_attribute WHERE user_id=' . $object->id;
                $result = $db->query($sql, StdLib_DB::QUERY_MODE_NUM);
            }

            $sql = 'SELECT tm_user_hash.attribute_key, title, tm_user_hash.type_id, list_value FROM tm_user_hash';

            if (!is_null($object) && isset($result[0][0]) && $result[0][0] > 0) {
                $sql .= ' LEFT JOIN tm_user_attribute ON tm_user_hash.attribute_key=tm_user_attribute.attribute_key
                          WHERE tm_user_attribute.user_id=' . $object->id . '
                          ORDER BY is_fill DESC, title';
            }
            */

            $sql
                = 'SELECT tm_user_hash.attribute_key, title, tm_user_hash.type_id, list_value, list_order, required, sort_order
                    FROM tm_user_hash ';
            if (!is_null($object)) {
                $sql
                    .= 'LEFT JOIN (
                        SELECT * FROM tm_user_attribute WHERE tm_user_attribute.user_id=' . $object->id . '
                     ) t2 ON tm_user_hash.attribute_key=t2.attribute_key
                     ORDER BY t2.is_fill DESC, title';
            } else {
                $sql .= ' ORDER BY title';
            }

            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_User_Hash::getInstanceByArray($res);
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
