<?php

require_once 'AttributeType.php';
require_once 'Attribute.php';


/**
 * class TM_Attribute_AttributeType
 *
 */
class TM_Attribute_AttributeType
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
    protected $_handler;

    /**
     * @var string
     * @access protected
     */
    protected $_description;

    /**
     * @var TM_Attribute_AttributeTypeMapper
     */
    protected $_mapper;

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
     * @return string
     * @access public
     */
    public function getHandler()
    {
        return $this->_handler;
    } // end of member function getHandler

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getDescription()
    {
        return $this->_db->prepareStringToOut($this->_description);
    } // end of member function getDescription

    /**
     *
     *
     * @param int $value
     * @return void
     * @access protected
     */
    protected function setId($value)
    {
        $this->_id = (int)$this->_db->prepareString($value);
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
     * @param string $value
     * @return void
     * @access public
     */
    public function setHandler($value)
    {
        $this->_handler = $this->_db->prepareString($value);
    } // end of member function setHandler

    /**
     *
     *
     * @param string $value
     * @return void
     * @access public
     */
    public function setDescription($value)
    {
        $this->_description = $this->_db->prepareString($value);
    } // end of member function setDescription

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
     * @param TM_Attribute_AttributeTypeMapper $mapper
     * @return TM_Attribute_AttributeType
     * @access public
     */
    public function __construct(TM_Attribute_AttributeTypeMapper $mapper)
    {
        $this->_db = StdLib_DB::getInstance();
        $this->_mapper = $mapper;
    }

    /**
     * @param $hash
     * @param $object
     * @param $value
     * @return void
     */
    public function getHTMLFrom($hash, $object, $value = '')
    {
        $html = '<input name="data[attribute][' . $hash->attributeKey . ']" value="';
        if ($object->searchAttribute($hash->attributeKey)) {
            $html .= $object->getAttribute($hash->attributeKey)->value;
        }
        $html .= '"/>';
        echo $html;
    }

    public function getHTML($hash, $object)
    {
        $html = '';
        if ($object->searchAttribute($hash->attributeKey)) {
            $html .= $object->getAttribute($hash->attributeKey)->value;
        }
        echo $html;
    }

    /**
     *
     *
     * @return void
    @access public
     */
    public function insertToDB()
    {
        $this->_mapper->insertToDB($this);
    }


    /**
     *
     *
     * @return void
     * @access public
     */
    public function updateToDB()
    {
        $this->_mapper->updateToDB($this);
    }

    /**
     *
     *
     * @return void
     * @access public
     */
    public function deleteFromDB()
    {
        $this->_mapper->deleteFromDB($this);
    }

    /**
     *
     *
     * @param TM_Attribute_AttributeTypeMapper $mapper
     * @param int $id
     * @return Attribute::TM_Attribute_AttributeType
     * @static
     * @access public
     */
    public static function getInstanceById(TM_Attribute_AttributeTypeMapper $mapper, $id)
    {

        return $mapper->getInstanceById($id);
    }

    /**
     *
     *
     * @param TM_Attribute_AttributeTypeMapper $mapper
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance(TM_Attribute_AttributeTypeMapper $mapper)
    {
        return $mapper->getAllInstance();
    }

    /**
     *
     *
     * @param TM_Attribute_AttributeTypeMapper $mapper
     * @param array $values
     * @return Attribute::TM_Attribute_Attribute
     * @static
     * @access public
     */
    public static function getInstanceByArray(TM_Attribute_AttributeTypeMapper $mapper, $values)
    {
        return $mapper->getInstanceByArray($values);
    }

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
        $this->setDescription($values['description']);
        $this->setHandler($values['handler']);
    } // end of member function fillFromArray

} // end of TM_Attribute_AttributeType
?>
