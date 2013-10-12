<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 19.11.11
 * Time: 14:38
 * To change this template use File | Settings | File Templates.
 */

class TM_User_Hash
{

    /**
     * @var TM_User_User
     * @access protected
     */
    protected $_user;

    /**
     *
     * @access protected
     */
    protected $_attributeKey = '';

    /**
     *
     * @access protected
     */
    protected $_title;

    /**
     * @var TM_Attribute_AttributeType
     * @access protected
     */
    protected $_type = null;

    /**
     * @var string
     */
    protected $_listValue = '';

    /**
     *
     * @access protected
     */
    protected $_db;

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
     * @return TM_Attribute_AttributeType
     * @access public
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getAttributeKey()
    {
        return $this->_attributeKey;
    }

    public function setAttributeKey($value)
    {
        $this->_attributeKey = $this->_db->prepareString($value);
    }

    /**
     *
     *
     * @param \TM_User_User $value value
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
     * @return string
     * @access public
     */
    public function getTitle()
    {
        return $this->_db->prepareStringToOut($this->_title);
    }

    /**
     *
     *
     * @param TM_Attribute_AttributeType $value
     *
     * @return void
     * @access protected
     */
    public function setType(TM_Attribute_AttributeType $value)
    {
        $this->_type = $value;
    }

    /**
     *
     *
     * @param string $value
     *
     * @return void
     * @access public
     */
    public function setTitle($value)
    {
        $this->_title = $this->_db->prepareString($value);
    }

    /**
     *
     *
     * @param array|string $value
     *
     * @return void
     * @access public
     */
    public function setValueList($value)
    {
        if (is_array($value)) {
            $this->_listValue = $this->_db->prepareString(implode('||', $value));
        } else {
            $this->_listValue = $value;
        }
    }

    /**
     *
     *
     * @param bool $asString
     *
     * @return array|string
     * @access public
     */
    public function getValueList($asString = false)
    {
        if ($asString) {
            return $this->_listValue;
        } else {
            return explode('||', $this->_db->prepareStringToOut($this->_listValue));
        }

    }

    /**
     * @param $name
     *
     * @throws Exception
     * @return mixed
     */
    public function __get($name)
    {
        $method = "get{$name}";
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            throw new Exception('Can not find method ' . $method . ' in class ' . __CLASS__);
        }
    }

    /**
     *
     *
     * @return TM_User_Hash
     * @access public
     */
    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
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
                = 'INSERT INTO tm_user_hash(user_id, attribute_key, title, type_id, list_value)
                    VALUES (NULL, "' . $this->_attributeKey . '", "' . $this->_title . '", ' . $this->_type->getId() . ', "' . $this->_listValue . ' ")';
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
                    SET title="' . $this->_title . '", type_id=' . $this->_type->getId() . ', list_value="' . $this->_listValue . ' "
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
            $o->fillFromArray($values);
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
                = 'SELECT tm_user_hash.attribute_key, title, tm_user_hash.type_id, list_value
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


    /**
     *
     *
     * @param array $values
     *
     * @return void
     * @access public
     */
    public function fillFromArray($values)
    {
        $this->setAttributeKey($values['attribute_key']);
        $this->setTitle($values['title']);

        $oMapper = new TM_User_AttributeTypeMapper();
        $this->setType($oMapper->getInstanceById($values['type_id']));
        unset($oMapper);
        $this->setValueList($values['list_value']);
    }
}
