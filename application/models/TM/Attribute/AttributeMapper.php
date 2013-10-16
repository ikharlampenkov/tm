<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 20.11.11
 * Time: 22:46
 * To change this template use File | Settings | File Templates.
 */
 
abstract class TM_Attribute_AttributeMapper {
    
    /**
     * @var StdLib_DB
     */
    protected $_db;

    /**

     * @return TM_Attribute_AttributeMapper
     * @access public
     */
    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
    }

    /**
     *
     *
     * @param TM_Attribute_Attribute $attribute
     * @return void
     * @abstract
     * @access public
     */
    abstract public function insertToDB(TM_Attribute_Attribute $attribute);

    /**
     *
     *
     * @param $attribute
     * @return void
     * @abstract
     * @access public
     */
    abstract public function updateToDB(TM_Attribute_Attribute $attribute);

    /**
     *
     *
     * @param $attribute
     * @return void
     * @abstract
     * @access public
     */
    abstract public function deleteFromDB(TM_Attribute_Attribute $attribute);

    /**
     *
     *
     * @param $object
     * @param int $key
     * @return TM_Attribute_Attribute
     * @abstract
     * @access public
     */
    abstract public function getInstanceByKey($object, $key);

    /**
     *
     *
     * @param $object
     * @param array $values
     * @return TM_Attribute_Attribute
     * @access public
     */
    abstract public function getInstanceByArray($object, $values);

    /**
     *
     *
     * @param $object
     * @return void array
     * @abstract
     * @access public
     */
    abstract public function getAllInstance($object);

}
