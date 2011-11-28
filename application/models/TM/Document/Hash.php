<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 19.11.11
 * Time: 14:38
 * To change this template use File | Settings | File Templates.
 */

class TM_Document_Hash
{

    /**
     *
     * @access protected
     */
    protected $_document;

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
     *
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
     * @return Document::TM_Document_Document
     * @access public
     */
    public function getDocument()
    {
        return $this->_document;
    } // end of member function getDocument

    /**
     *
     *
     * @return Attribute::TM_Attribute_AttribyteType
     * @access public
     */
    public function getType()
    {
        return $this->_type;
    } // end of member function getType

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getAttributeKey()
    {
        return $this->_attributeKey;
    } // end of member function getAttribyteKey

    public function setAttributeKey($value)
    {
        $this->_attributeKey = $this->_db->prepareString($value);
    }

    /**
     *
     *
     * @param Document::TM_Document_Document value

     * @return
     * @access protected
     */
    protected function setDocument(TM_Document_Document $value)
    {
        $this->_document = $value;

    } // end of member function setDocument

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
     * @param TM_Attribute_AttributeType $value
     * @return void
     * @access protected
     */
    public function setType(TM_Attribute_AttributeType $value ) {
        $this->_type = $value;
    } // end of member function setType

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
     * @param array|string $value

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
    } // end of member function setValueList

    /**
     *
     *
     * @param bool $asString
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

    } // end of member function getValueList

    /**
     * @param $name
     * @return mixed
     */
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

     * @return TM_Document_Hash
     * @access public
     */
    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
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
            $sql = 'INSERT INTO tm_document_hash(document_id, attribute_key, title, type_id, list_value)
                    VALUES (NULL, "' . $this->_attributeKey . '", "' . $this->_title . '", ' . $this->_type->getId() . ', "' . $this->_listValue . ' ")';
            $this->_db->query($sql);

            $this->_id = $this->_db->getLastInsertId();
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
            $sql = 'UPDATE tm_document_hash
                    SET title="' . $this->_title . '", type_id=' . $this->_type->getId() . ', list_value="' . $this->_listValue . ' "
                    WHERE document_id IS NULL AND attribute_key="' . $this->_attributeKey . '"';
            $this->_db->query($sql);
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
            $sql = 'DELETE FROM tm_document_hash
                    WHERE document_id IS NULL AND attribute_key="' . $this->_attributeKey . '"';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function deleteFromDb

    /**
     *
     *
     * @param int $key идентификатор задачи

     * @return TM_Document_Document
     * @static
     * @access public
     */
    public static function getInstanceById($key)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_document_hash WHERE document_id IS NULL AND attribute_key="' . $key . '"';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Document_Hash();
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
     * @param array $values

     * @return Document::TM_Document_Document
     * @static
     * @access public
     */
    public static function getInstanceByArray($values)
    {
        try {
            $o = new TM_Document_Hash();
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } // end of member function getInstanceByArray

    /**
     *
     * @param $object

     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance($object = null)
    {
        try {
            $db = StdLib_DB::getInstance();

            if (!is_null($object)) {
                $sql = 'SELECT COUNT(attribute_key) FROM tm_document_attribute WHERE document_id=' . $object->id;
                $result = $db->query($sql, StdLib_DB::QUERY_MODE_NUM);
            }

            $sql = 'SELECT tm_document_hash.attribute_key, title, tm_document_hash.type_id, list_value FROM tm_document_hash';

            if (!is_null($object) && isset($result[0][0]) && $result[0][0] > 0) {
                $sql .= ' LEFT JOIN tm_document_attribute ON tm_document_hash.attribute_key=tm_document_attribute.attribute_key
                          WHERE tm_document_attribute.document_id=' . $object->id . '
                          ORDER BY is_fill DESC, title';
            }
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Document_Hash::getInstanceByArray($res);
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
        $this->setAttributeKey($values['attribute_key']);
        $this->setTitle($values['title']);

        $this->setType(TM_Document_AttributeTypeFactory::getAttributeTypeById(new TM_Document_AttributeTypeMapper(), $values['type_id']));
        $this->setValueList($values['list_value']);
    } // end of member function fillFromArray

}
