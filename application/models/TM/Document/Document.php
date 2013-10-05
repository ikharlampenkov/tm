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
     * @var TM_User_User|null
     */
    protected $_user = null;

    /**
     * @var TM_FileManager_File|TM_FileManager_Folder
     */
    protected $_file = null;

    protected $_isFolder = false;

    /**
     * @var TM_Document_Document
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
     * @return TM_User_User
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
     *
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
     *
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
     *
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
     *
     * @return string
     * @access public
     */
    public function setDateCreate($value)
    {
        $value = $this->_db->prepareString($value);
        $this->_dateCreate = date("Y-m-d H:i:s", strtotime($value));
    }

    public function setIsFolder($isFolder)
    {
        $this->_isFolder = $isFolder;
        if (is_null($this->_file)) {
            if ($this->_isFolder) {
                $this->_file = new TM_FileManager_Folder(Zend_Registry::get('production')->files->path);
            } else {
                $this->_file = new TM_FileManager_File(Zend_Registry::get('production')->files->path);
            }
        }
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

    protected function _prepareBool($value)
    {
        if ($value) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     *
     *
     * @return TM_Document_Document
     * @access public
     */
    public function getParent()
    {
        return $this->_parentDocument;
    }

    /**
     *
     *
     * @param TM_Document_Document $parent
     * @param int                  $fill
     *
     * @return void
     * @access public
     */
    public function setParent($parent, $fill = 0)
    {
        if ($fill == 0 && $this->_isFolder == 1) {
            if ($parent != null && (($this->_parentDocument != null && $this->_parentDocument->getId() != $parent->getId()) || $this->_parentDocument == null)) {
                StdLib_Log::logMsg('TO ' . $parent->getFile()->getPath() . $parent->getFile()->getSubPath() . '/' . $parent->getFile()->getName(), StdLib_Log::StdLib_Log_INFO);
                $this->_file->move($parent->getFile()->getPath() . $parent->getFile()->getSubPath() . '/' . $parent->getFile()->getName());
            } elseif ($this->_parentDocument != null && $parent == null) {
                $this->_file->move($this->_parentDocument->getFile()->getPath());
            }
        }
        $this->_parentDocument = $parent;
        $this->_file->setSubPath($this->getParentPath());
    }

    protected function _prepareNull($value)
    {
        if (is_null($value) || empty($value)) {
            return 'NULL';
        } else {
            return $value->id;
        }

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
        //$this->_file = new TM_FileManager_File(Zend_Registry::get('production')->files->path);
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
        $this->_db->startTransaction();
        try {
            $sql
                = 'INSERT INTO tm_document(title, user_id, date_create, file, is_folder, parent_id)
                    VALUES ("' . $this->_title . '", ' . $this->_user->getId() . ', "' . $this->_dateCreate . '", "",
                             ' . $this->_prepareBool($this->_isFolder) . ', ' . $this->_prepareNull($this->_parentDocument) . ')';
            $this->_db->query($sql);

            $this->_id = $this->_db->getLastInsertId();

            if (!$this->_isFolder) {
                $this->_file->setSubPath($this->getParentPath());
                $fName = $this->_file->download('file');
                if ($fName !== false) {
                    $sql = 'UPDATE tm_document SET file="' . $fName . '" WHERE id=' . $this->_id;
                    $this->_db->query($sql);

                    if (empty($this->_title)) {
                        $this->_title = $this->_file->getOriginalName();
                        $sql = 'UPDATE tm_document SET title="' . $this->_title . '" WHERE id=' . $this->_id;
                        $this->_db->query($sql);
                    }
                }
            } else {
                $this->_file->setSubPath($this->getParentPath());
                $fName = $this->_file->download(StdLib_Functions::translitIt($this->_title));
                if ($fName !== false) {
                    $sql = 'UPDATE tm_document SET file="' . $fName . '" WHERE id=' . $this->_id;
                    $this->_db->query($sql);
                }
            }
            $this->saveAttributeList();
            $this->_db->commitTransaction();
        } catch (Exception $e) {
            $this->_db->rollbackTransaction();
            throw new Exception($e->getMessage());
        }
    } // end of member function insertToDb


    //title, date_create, user_id, file, is_folder, parent_id

    /**
     *
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function updateToDb()
    {
        $this->_db->startTransaction();
        try {
            $sql
                = 'UPDATE tm_document
                    SET title="' . $this->_title . '", user_id="' . $this->_user->getId() . '", date_create="' . $this->_dateCreate . '",
                        is_folder=' . $this->_prepareBool($this->_isFolder) . ', parent_id=' . $this->_prepareNull($this->_parentDocument) . '
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);

            if (!$this->_isFolder) {
                $this->_file->setSubPath($this->getParentPath());
                $fName = $this->_file->download('file');
                if ($fName !== false) {
                    $sql = 'UPDATE tm_document SET file="' . $fName . '" WHERE id=' . $this->_id;
                    $this->_db->query($sql);

                    if (empty($this->_title)) {
                        $this->_title = $this->_file->getOriginalName();
                        $sql = 'UPDATE tm_document SET title="' . $this->_title . '" WHERE id=' . $this->_id;
                        $this->_db->query($sql);
                    }
                }
            }
            $this->saveAttributeList();
            $this->_db->commitTransaction();
        } catch (Exception $e) {
            $this->_db->rollbackTransaction();
            throw new Exception($e->getMessage());
        }
    } // end of member function updateToDb

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
            $docList = TM_Document_Document::getAllInstance($this->_user, $this->_id);
            foreach ($docList as $doc) {
                $doc->deleteFromDb();
            }

            $this->_file->delete();

            $sql
                = 'DELETE FROM tm_document
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function toArchive()
    {
        try {
            $sql
                = 'UPDATE tm_document SET is_archive=1
                        WHERE id=' . $this->_id;
            $this->_db->query($sql);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function fromArchive()
    {
        try {
            $sql
                = 'UPDATE tm_document SET is_archive=0
                            WHERE id=' . $this->_id;
            $this->_db->query($sql);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int $id идентификатор задачи
     *
     * @throws Exception
     * @return TM_Document_Document
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
     * @param       $user
     * @param array $values
     *
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
     * @param int          $parentId
     * @param int          $isFolder
     * @param bool         $isArchive
     *
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance(TM_User_User $user, $parentId = 0, $isFolder = -1, $isArchive = false)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = '';

            if ($parentId > 0) {
                $sql
                    = 'SELECT * FROM tm_document
                        WHERE parent_id=' . (int)$parentId;
            } elseif ($parentId == -1) {
                $sql = 'SELECT * FROM tm_document ';
                if ($isArchive) {
                    $sql .= ' WHERE is_archive=1 ';
                } else {
                    $sql .= ' WHERE is_archive=0 ';
                }

            } elseif ($parentId == 0) {
                $sql
                    = 'SELECT * FROM tm_document
                        WHERE parent_id IS NULL ';
                if ($isArchive) {
                    $sql .= ' AND is_archive=1 ';
                } else {
                    $sql .= ' AND is_archive=0 ';
                }
            }

            /*
            if ($parentId == -1 && $isFolder != -1) {
                $sql .= ' WHERE ';
            } elseif ($isFolder != -1) {
                $sql .= ' AND ';
            }
            */

            if ($isFolder == 1) {
                $sql .= ' AND is_folder=1';
            } elseif ($isFolder == 0) {
                $sql .= ' AND is_folder=0';
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

    public static function getDocumentByTask(TM_User_User $user, TM_Task_Task $task)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT * FROM tm_document, tm_task_document
                    WHERE tm_document.is_folder=0
                      AND tm_document.id=tm_task_document.document_id
                      AND tm_task_document.task_id=' . $task->getId();
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
    }

    /**
     * Возвращает количество документов для задачи с учетом папки
     * @param TM_User_User $user
     * @param TM_Task_Task $task
     *
     * @return int
     * @throws Exception
     */
    public static function calculateCountDocumentByTask(TM_User_User $user, TM_Task_Task $task)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT COUNT(tm_document.id) AS cnt FROM tm_document, tm_task_document
                     WHERE tm_document.is_folder=0
                       AND (tm_document.id=tm_task_document.document_id OR tm_document.parent_id=tm_task_document.document_id)
                       AND task_id=' . $task->getId();
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0]['cnt'])) {
                return $result[0]['cnt'];
            } else {
                return 0;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getDocumentStatistic()
    {
        $statArray = array('doc_count' => 0);
        try {
            $sql
                = 'SELECT COUNT(tm_document.id) AS cnt FROM tm_document
                     WHERE tm_document.is_folder=0
                       AND tm_document.parent_id=' . $this->_id;
            $result = $this->_db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);
            if (isset($result[0]['cnt'])) {
                $statArray['doc_count'] = $result[0]['cnt'];
            }

            return $statArray;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getDocumentFolderByTask(TM_User_User $user, TM_Task_Task $task)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT * FROM tm_document, tm_task_document
                    WHERE tm_document.is_folder=1
                      AND tm_document.id=tm_task_document.document_id
                      AND tm_task_document.task_id=' . $task->getId();
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                return TM_Document_Document::getInstanceByArray($user, $result[0]);
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function setLinkToTask($task)
    {
        try {
            $sql = 'INSERT INTO tm_task_document(task_id, document_id) VALUES(' . $task->id . ', ' . $this->_id . ')';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteLinkToTask($task)
    {
        try {
            $sql = 'DELETE FROM tm_task_document WHERE task_id=' . $task->id . ' AND document_id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getDocumentByDiscussion(TM_User_User $user, TM_Discussion_Discussion $discussion)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT * FROM tm_document, tm_discussion_document
                    WHERE tm_document.is_folder=0
                      AND tm_discussion_document.is_doc=1
                      AND tm_document.id=tm_discussion_document.document_id
                      AND tm_discussion_document.discussion_id=' . $discussion->getId();
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
    }

    public static function getDocumentFolderByDiscussion(TM_User_User $user, TM_Discussion_Discussion $discussion)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql
                = 'SELECT * FROM tm_document, tm_discussion_document
                    WHERE tm_document.is_folder=1
                      AND tm_discussion_document.is_doc=0
                      AND tm_document.id=tm_discussion_document.document_id
                      AND tm_discussion_document.discussion_id=' . $discussion->getId();
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                return TM_Document_Document::getInstanceByArray($user, $result[0]);
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function setLinkToDiscussion($discussion, $is_doc = 0)
    {
        try {
            $sql
                = 'INSERT INTO tm_discussion_document(discussion_id, document_id, is_doc)
                    VALUES(' . $discussion->id . ', ' . $this->_id . ', ' . $is_doc . ')';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteLinkToDiscussion($discussion)
    {
        try {
            $sql
                = 'DELETE FROM tm_discussion_document
                    WHERE discussion_id=' . $discussion->id . ' AND document_id=' . $this->_id;
            $this->_db->query($sql);
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
        $this->setDateCreate($values['date_create']);

        $o_user = TM_User_User::getInstanceById($values['user_id']);
        $this->setUser($o_user);

        $this->setIsFolder($values['is_folder']);

        if ($this->_isFolder) {
            $this->_file = new TM_FileManager_Folder(Zend_Registry::get('production')->files->path, $values['file']);
        } else {
            $this->_file = new TM_FileManager_File(Zend_Registry::get('production')->files->path, $values['file']);
        }

        $oDocument = TM_Document_Document::getInstanceById($values['parent_id']);
        if ($oDocument !== false) {
            $this->setParent($oDocument, 1);
        }

        $this->_file->setSubPath($this->getParentPath());

        $this->getAttributeList();
    } // end of member function fillFromArray

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
            //$oAttribute->insertToDB();
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
                try {
                    $attribute->insertToDB();
                } catch (Exception $e) {
                    $attribute->updateToDB();
                }
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

    protected function getParentPath()
    {
        $path = '';
        $pathArray = $this->getPathToDocument();
        if (!empty($pathArray)) {
            foreach ($pathArray as $value) {
                $path .= '/' . $value->_file->getName();
            }
        }
        /*
        if (!is_null($this->_parentDocument)) {
            $path .= '/' . $this->_parentDocument->_file->getName();
        }
        */
        return $path;
    }

    protected function _pathToDocument(&$pathArray = array())
    {

    }

} // end of TM_Document_Document
?>