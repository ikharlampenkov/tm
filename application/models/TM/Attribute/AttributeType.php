<?php

require_once 'AttributeType.php';
require_once 'Attribute.php';


/**
 * class TM_Attribute_AttributeType
 *
 */
class TM_Attribute_AttributeType
{
    /**
     * @var integer
     * @access protected
     */
    protected $_id;

    /**
     *
     * @access protected
     */
    protected $_title;

    /**
     * @var string
     * @access protected
     */
    protected $_handler;

    /**
     * @var string
     * @access protected
     */
    protected $_description;

    /**
     * @var StdLib_DB
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
    }

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getHandler()
    {
        return $this->_handler;
    }

    /**
     *
     *
     * @return string
     * @access public
     */
    public function getDescription()
    {
        return $this->_db->prepareStringToOut($this->_description);
    }

    /**
     *
     *
     * @param int $value
     *
     * @return void
     * @access protected
     */
    public function setId($value)
    {
        $this->_id = (int)$this->_db->prepareString($value);
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
     * @param string $value
     *
     * @return void
     * @access public
     */
    public function setHandler($value)
    {
        $this->_handler = $this->_db->prepareString($value);
    }

    /**
     *
     *
     * @param string $value
     *
     * @return void
     * @access public
     */
    public function setDescription($value)
    {
        $this->_description = $this->_db->prepareString($value);
    }

    /**
     * @param $name имя функции
     *
     * @return mixed
     * @throws Exception
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
     * @return TM_Attribute_AttributeType
     * @access public
     */
    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
    }

    /**
     * @param $hash
     * @param $object
     * @param $value
     *
     * @return void
     */
    public function getHTMLFrom($hash, $object, $value = '')
    {
        $html = '<input type="text" name="data[attribute][' . $hash->attributeKey . ']" value="';
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
    /*
    public function insertToDB()
    {
        $this->_mapper->insertToDB($this);
    }
    */


    /**
     *
     *
     * @return void
     * @access public
     */
    /*
    public function updateToDB()
    {
        $this->_mapper->updateToDB($this);
    }
    */

    /**
     *
     *
     * @return void
     * @access public
     */
    /*
    public function deleteFromDB()
    {
        $this->_mapper->deleteFromDB($this);
    }
    */

    /**
     *
     *
     * @param TM_Attribute_AttributeTypeMapper $mapper
     * @param int                              $id
     *
     * @return Attribute::TM_Attribute_AttributeType
     * @static
     * @access public
     */
    /*
    public static function getInstanceById(TM_Attribute_AttributeTypeMapper $mapper, $id)
    {

        return $mapper->getInstanceById($id);
    }
    */

    /**
     *
     *
     * @param TM_Attribute_AttributeTypeMapper $mapper
     *
     * @return array
     * @static
     * @access public
     */
    /*
    public static function getAllInstance(TM_Attribute_AttributeTypeMapper $mapper)
    {
        return $mapper->getAllInstance();
    }
    */

    /**
     *
     *
     * @param TM_Attribute_AttributeTypeMapper $mapper
     * @param array                            $values
     *
     * @return Attribute::TM_Attribute_Attribute
     * @static
     * @access public
     */
    /*
    public static function getInstanceByArray(TM_Attribute_AttributeTypeMapper $mapper, $values)
    {
        return $mapper->getInstanceByArray($values);
    }
    */

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
        $this->setDescription($values['description']);
        $this->setHandler($values['handler']);
    }

}