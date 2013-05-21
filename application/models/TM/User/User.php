<?php

/*id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(32) NOT NULL ,
  `password` VARCHAR(32) NOT NULL ,
  `role_id` INT NOT NULL ,
  `date_create
*/

/**
 * class TM_User_User
 *
 */
class TM_User_User
{
    /**
     * @var int
     */
    protected $_id;

    protected $_login;

    protected $_password;

    /**
     * @var TM_User_Role|null
     */
    protected $_role = null;

    protected $_dateCreate;

    /**
     * @var string тип - expert, client, admin
     */
    protected $_type = 'client';

    /**
     * @var array
     */
    protected $_attributeList = array();

    protected $_db;


    public function setDateCreate($value)
    {
        $value = $this->_db->prepareString($value);
        $this->_dateCreate = date("Y-m-d H:i:s", strtotime($value));
    }

    public function getDateCreate()
    {
        return $this->_dateCreate;
    }

    protected function setId($id)
    {
        $this->_id = $id;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setLogin($value)
    {
        $this->_login = $this->_db->prepareString($value);
    }

    public function getLogin()
    {
        return $this->_login;
    }

    public function setPassword($value)
    {
        $this->_password = $this->_db->prepareString($value);
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setRole(TM_User_Role $value)
    {
        $this->_role = $value;
    }

    public function getRole()
    {
        return $this->_role;
    }

    public function setType($isClient)
    {
        $this->_type = $isClient;
    }

    public function getType()
    {
        return $this->_type;
    }

    public function __get($name)
    {
        $method = "get{$name}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

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
            if (TM_User_User::checkLogin($this->_login)) {
                throw new Exception('Пользователь с таким логином существует');
            }
            $sql = 'INSERT INTO tm_user(login, password, role_id, date_create, type)
                    VALUES ("' . $this->_login . '", "' . $this->_password . '", ' . $this->_role->getId() . ', "' . $this->_dateCreate . '", "' . $this->_type . '")';
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
    public function updateToDb()
    {
        try {
            $sql = 'UPDATE tm_user
                    SET login="' . $this->_login . '", password="' . $this->_password . '",
                        role_id="' . $this->_role->getId() . '", date_create="' . $this->_dateCreate . '",
                        type="' . $this->_type . '"
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);
            $this->saveAttributeList();
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
    public function deleteFromDb()
    {
        try {
            $sql = 'DELETE FROM tm_user
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function deleteFromDb

    /**
     *
     *
     * @param int id
     * @return TM_User_User
     * @static
     * @access public
     */
    public static function getInstanceById($id)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_user WHERE id=' . (int)$id;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_User_User();
                $o->fillFromArray($result[0]);
                return $o;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function getInstanceById

    /**
     *
     *
     * @param int id
     * @return TM_User_User
     * @static
     * @access public
     */
    public static function getInstanceByLogin($login)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_user WHERE login="' . $login . '"';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_User_User();
                $o->fillFromArray($result[0]);
                return $o;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function checkLogin($login)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT COUNT(id) AS cnt FROM tm_user WHERE login="' . $login . '"';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0]['cnt']) && $result[0]['cnt'] > 0) {
                return true;
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
     * @return TM_User_User
     * @static
     * @access public
     */
    public static function getInstanceByArray($values)
    {
        try {
            $o = new TM_User_User();
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function getInstanceByArray

    /**
     *
     *
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance($type = '')
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_user ';
            if ($type !== '') {
                $sql .= ' WHERE type="' . $type . '" ';
            }
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_User_User::getInstanceByArray($res);
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
     * @param array $values
     * @return void
     * @access public
     */
    public function fillFromArray($values)
    {
        $this->setId($values['id']);
        $this->setLogin($values['login']);
        $this->setDateCreate($values['date_create']);
        $this->setPassword($values['password']);

        $o_role = TM_User_Role::getInstanceById($values['role_id']);
        $this->setRole($o_role);

        $this->setType($values['type']);

        $this->getAttributeList();
    } // end of member function fillFromArray

    public function getAttributeList()
    {
        if (is_null($this->_attributeList) || empty($this->_attributeList)) {
            try {
                $attributeList = TM_Attribute_Attribute::getAllInstance(new TM_User_AttributeMapper(), $this);
                if ($attributeList !== false) {
                    foreach ($attributeList as $attribute) {
                        $this->_attributeList[$attribute->attribyteKey] = $attribute;
                    }
                }

                return $this->_attributeList;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        } else {
            return $this->_attributeList;
        }
    }

    /**
     * @param $key
     * @return TM_Attribute_Attribute
     */
    public function getAttribute($key)
    {
        return $this->_attributeList[$key];
    }

    public function setAttribute($key, $value)
    {
        if ($this->searchAttribute($key)) {
            $this->_attributeList[$key]->setValue($value);

        } else {
            $oHash = TM_User_Hash::getInstanceById($key);
            $oAttribute = new TM_Attribute_Attribute(new TM_User_AttributeMapper(), $this);
            $oAttribute->setAttribyteKey($key);
            $oAttribute->setType($oHash->getType());
            $oAttribute->setValue($value);

            $this->_attributeList[$key] = $oAttribute;
            $oAttribute->insertToDB();
        }
    }

    public function searchAttribute($needle)
    {
        if (is_null($this->_attributeList) && !empty($this->_attributeList)) {
            return false;
        } else {
            return array_key_exists($needle, $this->_attributeList);
        }
    }

    protected function saveAttributeList()
    {
        if (!is_null($this->_attributeList) && !empty($this->_attributeList)) {
            foreach ($this->_attributeList as $attribute) {
                $attribute->updateToDB();
            }
        }
    }


}