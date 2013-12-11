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

    /**
     * @var string
     */
    protected $_login;

    /**
     * @var string
     */
    protected $_password;

    /**
     * @var TM_User_Role|null
     */
    protected $_role = null;

    /**
     * @var string
     */
    protected $_dateCreate;

    /**
     * @var string тип - expert, client, admin
     */
    protected $_type = 'client';

    /**
     * @var TM_Organization_Organization|null
     */
    protected $_organization = null;

    /**
     * @var TM_Attribute_AttributeCollection
     */
    protected $_attributeList = null;

    /**
     * @var StdLib_DB
     */
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

    /**
     * @param null|\TM_Organization_Organization $organization
     */
    public function setOrganization($organization)
    {
        $this->_organization = $organization;
    }

    /**
     * @return null|\TM_Organization_Organization
     */
    public function getOrganization()
    {
        return $this->_organization;
    }

    /**
     * @param TM_Organization_Organization $value
     *
     * @return string|int
     */
    protected function _prepareNull($value)
    {
        if ($value == null) {
            return 'NULL';
        } else {
            return $value->getId();
        }
    }

    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            throw new Exception('Can not find method ' . $method . ' in class ' . __CLASS__);
        }
    }

    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
        $this->_attributeList = new TM_Attribute_AttributeCollection($this, null, new TM_User_AttributeMapper());
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
            $sql
                    = 'INSERT INTO tm_user(login, password, role_id, date_create, type, organization_id)
                    VALUES ("' . $this->_login . '", "' . $this->_password . '", ' . $this->_role->getId() . ', "' . $this->_dateCreate . '", "' . $this->_type . '", ' . $this->_prepareNull($this->_organization) . ')';
            $this->_db->query($sql);

            $this->_id = $this->_db->getLastInsertId();
            $this->saveAttributeList();
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
                    = 'UPDATE tm_user
                    SET login="' . $this->_login . '", password="' . $this->_password . '",
                        role_id="' . $this->_role->getId() . '", date_create="' . $this->_dateCreate . '",
                        type="' . $this->_type . '", organization_id=' . $this->_prepareNull($this->_organization) . '
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);

            $this->saveAttributeList();
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
            $sql = 'DELETE FROM tm_user WHERE id=' . $this->_id;
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
    }

    /**
     *
     *
     * @param int $login
     *
     * @throws Exception
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
     *
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
    }

    /**
     *
     *
     * @param TM_Organization_Organization $organization
     * @param string $type
     *
     * @throws Exception
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance($organization = null, $type = '')
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_user WHERE 1';
            if ($organization != null) {
                $sql .= ' AND organization_id=' . $organization->getId() . ' ';
            }
            if ($type !== '') {
                $sql .= ' AND type="' . $type . '" ';
            }

            $sql .= ' ORDER BY organization_id, id';
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
        $this->setId($values['id']);
        $this->setLogin($values['login']);
        $this->setDateCreate($values['date_create']);
        $this->setPassword($values['password']);

        $o_role = TM_User_Role::getInstanceById($values['role_id']);
        $this->setRole($o_role);

        $this->setType($values['type']);

        $oMapper = new TM_User_AttributeMapper();
        $this->_attributeList = $oMapper->getAllInstance($this);
        unset($oMapper);

        if ($values['organization_id'] != null) {
            $this->setOrganization(TM_Organization_Organization::getInstanceById($values['organization_id']));
        }
    }

    public function getAttributeList()
    {
        return $this->_attributeList;
    }

    /**
     * @param $key
     *
     * @return TM_Attribute_Attribute
     */
    public function getAttribute($key)
    {
        return $this->_attributeList->at($key);
    }

    public function setAttribute($key, $value)
    {
        $oHash = TM_User_Hash::getInstanceById($key);
        if ($this->_attributeList->search($key)) {
            $this->_attributeList->at($key)->setValue($value);

            if ($oHash->getType() instanceof TM_Attribute_AttributeTypeList) {
                $keyO = array_search($value, $oHash->getValueList(false, true));
                $temp = $oHash->getListOrder();
                if ($key !== false && isset($temp[$keyO])) {
                    $this->_attributeList->at($key)->setAttributeOrder($temp[$keyO]);
                }
            }
        } else {
            $oAttribute = new TM_Attribute_Attribute($this);
            $oAttribute->setAttributeKey($key);
            $oAttribute->setType($oHash->getType());
            $oAttribute->setValue($value);

            if ($oHash->getType() instanceof TM_Attribute_AttributeTypeList) {
                $key = array_search($value, $oHash->getValueList(false, true));
                $temp = $oHash->getListOrder();
                if ($key !== false && isset($temp[$key])) {
                    $oAttribute->setAttributeOrder($temp[$key]);
                }
            }

            $this->_attributeList->add($key, $oAttribute);
        }
    }

    public function searchAttribute($needle)
    {
        if ($this->_attributeList->getTotal() == 0) {
            return false;
        } else {
            return $this->_attributeList->search($needle);
        }
    }

    protected function saveAttributeList()
    {
        if ($this->_attributeList->getTotal() > 0) {
            $oMapper = new TM_User_AttributeMapper();
            foreach ($this->_attributeList as $attribute) {
                try {
                    $oMapper->insertToDb($attribute);
                } catch (Exception $e) {
                    $oMapper->updateToDB($attribute);
                }
            }
            unset($oMapper);
        }
    }


}