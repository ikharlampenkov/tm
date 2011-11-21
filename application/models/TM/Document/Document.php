<?php

/*
 * id,
  title,
  date_create,
  user_id,
  file,
  is_folder,
  parent_id
 */

/**
 * class TM_Document_Document
 *
 */
class TM_Document_Document
{

    /** Aggregations: */

    /** Compositions: */

    /*** Attributes: ***/

    /**
     *
     * @access protected
     */
    protected $_id;

    /**
     *
     * @access protected
     */
    protected $_title;

    /**
     *
     * @access protected
     */
    protected $_dateCreate;

    /**
     *
     * @access protected
     */
    protected $_user = null;

    protected $_file = null;

    protected $_isFolder = false;

    /**
     *
     * @access protected
     */
    protected $_parentDocument = null;

    /**
     * @var array
     */
    protected $_attributeList = array();

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
    } // end of member function getId

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getTitle()
    {
        return $this->_db->prepareStringToOut($this->_title);
    } // end of member function getTitle

    /**
     *
     *
     * @return User::TM_User_User
     * @access public
     */
    public function getUser()
    {
        return $this->_user;
    } // end of member function getUser

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getDateCreate()
    {
        return $this->_dateCreate;
    } // end of member function getDateCreate

    /**
     *
     *
     * @param int $value

     * @return void
     * @access protected
     */
    protected function setId($value)
    {
        $this->_id = (int)$value;
    } // end of member function setId

    /**
     *
     *
     * @param string $value

     * @return void
     * @access public
     */
    public function setTitle($value)
    {
        $this->_title = $this->_db->prepareString($value);
    } // end of member function setTitle

    /**
     *
     *
     * @param TM_User_User $value

     * @return void
     * @access public
     */
    public function setUser(TM_User_User $value)
    {
        $this->_user = $value;
    } // end of member function setUser

    /**
     *
     *
     * @param string $value

     * @return string
     * @access public
     */
    public function setDateCreate($value)
    {
        $value = $this->_db->prepareString($value);
        $this->_dateCreate = date("Y-m-d H:i:s", strtotime($value));
    } // end of member function setDateCreate

    public function setIsFolder($isFolder)
    {
        $this->_isFolder = $isFolder;
    }

    public function getIsFolder()
    {
        return $this->_isFolder;
    }

    public function setFile($file)
    {
        $this->_file = $file;
    }

    public function getFile()
    {
        return $this->_file;
    }

    public function __get($name)
    {
        $method = "get{$name}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

    /**
     *
     *
     * @return TM_Document_Document
     * @access public
     */
    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
        $this->_file = new TM_FileManager_File(Zend_Registry::get('production')->files->path);
    } // end of member function __construct

    /**
     *
     *
     * @return void
     * @access public
     */
    public function insertToDb()
    {
        try {
            $sql = 'INSERT INTO tm_document(title, user_id, date_create, file, is_folder, parent_id)
                    VALUES ("' . $this->_title . '", ' . $this->_user->getId() . ', "' . $this->_dateCreate . '", "", ' . $this->_isFolder . ', ' . $this->_parentDocument->id . ')';
            $this->_db->query($sql);

            $this->_id = $this->_db->getLastInsertId();
            //$this->saveParent();
            //$this->saveChild();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function insertToDb


    //title, date_create, user_id, file, is_folder, parent_id

    /**
     *
     *
     * @return void
     * @access public
     */
    public function updateToDb()
    {
        try {
            $sql = 'UPDATE tm_document
                    SET title="' . $this->_title . '", user_id="' . $this->_user->getId() . '", date_create="' . $this->_dateCreate . '",
                        is_folder=' . $this->_isFolder . ', parent_id=' . $this->_parentDocument->id . ' 
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);

            $this->saveParent();
            $this->saveAttributeList();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function updateToDb

    /**
     *
     *
     * @return void
     * @access public
     */
    public function deleteFromDb()
    {
        try {
            $this->deleteAllParent();
            $this->saveParent();

            $sql = 'DELETE FROM tm_document
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function deleteFromDb

    /**
     *
     *
     * @param int $id идентификатор задачи

     * @return Document::TM_Document_Document
     * @static
     * @access public
     */
    public static function getInstanceById($id)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_document WHERE id=' . (int)$id;
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Document_Document();
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
     * @param $user
     * @param array $values
     * @return TM_Document_Document
     * @static
     * @access public
     */
    public static function getInstanceByArray($user, $values)
    {
        try {
            $o = new TM_Document_Document();
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function getInstanceByArray

    /**
     *
     *
     * @param TM_User_User $user
     * @param int $parentId

     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance(TM_User_User $user, $parentId = 0)
    {
        try {
            $db = StdLib_DB::getInstance();
            
            if ($parentId > 0 ) {
                $sql = 'SELECT * FROM tm_document
                        WHERE parent_id=' . (int)$parentId;
            } elseif ($parentId == -1) {
                $sql = 'SELECT * FROM tm_document';
            } else {
                $sql = 'SELECT * FROM tm_document
                        WHERE parent_id IS NULL ';
            }

            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Document_Document::getInstanceByArray($user, $res);
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
        $this->setTitle($values['title']);
        $this->setDateCreate($values['date_create']);

        $o_user = TM_User_User::getInstanceById($values['user_id']);
        $this->setUser($o_user);

        $this->setIsFolder($values['is_folder']);

        $this->_file->setName($values['file']);

        //$this->getParent();
        $this->getAttributeList();
    } // end of member function fillFromArray

    /**
     *
     *
     * @return array
     * @access public
     */
    public function getParent()
    {
        if (is_null($this->_parentDocument) || empty($this->_parentDocument)) {
            try {
                $sql = 'SELECT * FROM tm_task_relation WHERE child_id=' . $this->_id;
                $result = $this->_db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

                if (isset($result[0]['parent_id'])) {
                    foreach ($result as $res) {
                        $this->_parentDocument[] = TM_Document_Document::getInstanceById($res['parent_id']);
                    }
                } else {
                    $this->_parentDocument = array();
                }
                return $this->_parentDocument;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        } else {
            return $this->_parentDocument;
        }
    } // end of member function getParent

    /**
     *
     *
     * @param Document::TM_Document_Document parent

     * @return
     * @access public
     */
    public function addParent(TM_Document_Document $parent)
    {
        if ($this->searchParent($parent) === false) {
            $this->_parentDocument[] = $parent;
        }
    } // end of member function addParent

    /**
     *
     *
     * @param Document::TM_Document_Document parent

     * @return
     * @access public
     */
    public function deleteParent($parent)
    {
        $key = $this->searchParent($parent);
        if ($key !== false) {
            unset($this->_parentDocument[$key]);
        }
    } // end of member function deleteParent

    public function deleteAllParent()
    {
        $this->_parentDocument = array();
    }

    protected function saveParent()
    {
        try {
            $sql = 'DELETE FROM tm_task_relation WHERE child_id=' . $this->_id;
            $this->_db->query($sql);

            if (!is_null($this->_parentDocument) && !empty($this->_parentDocument)) {
                $sql = 'INSERT INTO tm_task_relation(parent_id, child_id) VALUES';

                foreach ($this->_parentDocument as $parent) {
                    $sql .= '(' . $parent->getId() . ', ' . $this->_id . '), ';
                }

                $sql = substr($sql, 0, strlen($sql) - 2);
                $this->_db->query($sql);
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function searchParent(TM_Document_Document $needle)
    {
        if (is_null($this->_parentDocument)) {
            return false;
        } else {
            foreach ($this->_parentDocument as $key => $child) {
                if ($child->_id == $needle->getId()) {
                    return $key;
                }
            }
            return false;
        }
    }

    public function getAttributeList()
    {
         if (is_null($this->_attributeList) || empty($this->_attributeList)) {
            try {
                $attributeList = TM_Attribute_Attribute::getAllInstance(new TM_Document_AttributeMapper(), $this);
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

    public function getAttribute($key)
    {
        return $this->_attributeList[$key];
    }

    public function setAttribute($key, $value)
    {
        if ($this->searchAttribute($key)) {
            $this->_attributeList[$key]->setValue($value);

        } else {
            $oHash = TM_Document_Hash::getInstanceById($key);
            $oAttribute = new TM_Attribute_Attribute(new TM_Document_AttributeMapper(), $this);
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

    public function getPathToDocument(&$pathArray = array())
    {
        try {
            if (!is_null($this->_parentDocument)) {
                $pathArray[] = $this->_parentDocument;
                $this->_parentDocument->getPathToDocument($pathArray);
            }
            return array_reverse($pathArray);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function _pathToDocument(&$pathArray = array())
    {

    }

} // end of TM_Document_Document
?>