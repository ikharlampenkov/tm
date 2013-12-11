<?php

/**
 * class TM_Organization_Organization
 *
 */
class TM_Organization_Organization
{
    /**
     *
     * @access protected
     */
    protected $_id = 0;

    /**
     *
     * @access protected
     */
    protected $_title;

    /**
     * @var TM_User_User
     * @access protected
     */
    protected $_user = null;

    /**
     * @var string
     * @access protected
     */
    protected $_dateCreate;

    /**
     * @var TM_Attribute_AttributeCollection
     */
    protected $_attributeList = null;

    /**
     *
     * @var StdLib_DB
     * @access protected
     */
    protected $_db;


    /**
     *
     *
     * @return int
     * @access public
     */
    public function getId()
    {
        return $this->_id;
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
     * @return string
     * @access public
     */
    public function getDateCreate()
    {
        return $this->_dateCreate;
    }

    /**
     *
     *
     * @param int $value
     *
     * @return void
     * @access protected
     */
    protected function setId($value)
    {
        $this->_id = (int)$value;
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
     * @param TM_User_User $value
     *
     * @return void
     * @access public
     */
    public function setUser(TM_User_User $value)
    {
        $this->_user = $value;
    }

    /**
     *
     *
     * @param string $value
     *
     * @return string
     * @access public
     */
    public function setDateCreate($value)
    {
        $value = $this->_db->prepareString($value);
        $this->_dateCreate = date("Y-m-d H:i:s", strtotime($value));
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

    /**
     *
     *
     * @return TM_Organization_Organization
     * @access public
     */
    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
        $this->_attributeList = new TM_Attribute_AttributeCollection($this, null, new TM_Organization_AttributeMapper());
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
                = 'INSERT INTO tm_organization(title, user_id, date_create)
                    VALUES ("' . $this->_title . '", ' . $this->_user->getId() . ', "' . $this->_dateCreate . '")';
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
                = 'UPDATE tm_organization
                    SET title="' . $this->_title . '", date_create="' . $this->_dateCreate . '"
                    WHERE id=' . $this->_id; //user_id=' . $this->_user->getId() . ',
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
            $sql
                = 'DELETE FROM tm_organization
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int $id идентификатор организации
     *
     * @throws Exception
     * @return TM_Organization_Organization
     * @static
     * @access public
     */
    public static function getInstanceById($id)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_organization WHERE id=' . (int)$id;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Organization_Organization();
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
     * @param       $user
     * @param array $values
     *
     * @throws Exception
     * @return TM_Organization_Organization
     * @static
     * @access public
     */
    public static function getInstanceByArray($user, $values)
    {
        try {
            $o = new TM_Organization_Organization();
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param TM_User_User $user
     *
     * @throws Exception
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance(TM_User_User $user)
    {
        try {
            $db = StdLib_DB::getInstance();

            $sql = 'SELECT * FROM tm_organization ';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Organization_Organization::getInstanceByArray($user, $res);
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
        $this->setTitle($values['title']);

        //$o_user = TM_User_User::getInstanceById($values['user_id']);
        $this->setUser(new TM_User_User());

        $this->setDateCreate($values['date_create']);

        $oMapper = new TM_Organization_AttributeMapper();
        $this->_attributeList = $oMapper->getAllInstance($this);
        unset($oMapper);
    }

    /**
     * @return array
     * @throws Exception
     */
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
        $oHash = TM_Organization_Hash::getInstanceById($key);
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
            $oMapper = new TM_Organization_AttributeMapper();
            foreach ($this->_attributeList as $attribute) {
                try {
                    $oMapper->insertToDB($attribute);
                } catch (Exception $e) {
                    $oMapper->updateToDB($attribute);
                }
            }
            unset($oMapper);
        }
    }

}