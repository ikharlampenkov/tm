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
     * @param $attribute
     * @return void
     * @abstract
     * @access public
     */
    abstract public function insertToDB($attribute);

    /**
     *
     *
     * @return void
     * @abstract
     * @access public
     */
    abstract public function updateToDB($attribute);

    /**
     *
     *
     * @return void
     * @abstract
     * @access public
     */
    abstract public function deleteFromDB($attribute);

    /**
     *
     *
     * @param TM_Task_Task $task
     * @param int $key
     * @return Attribute::TM_Attribute_Attribute
     * @abstract
     * @access public
     */
    abstract public function getInstanceByKey(TM_Task_Task $task, $key);

    /**
     *
     *
     * @param TM_Task_Task $task
     * @param array $values
     * @return Attribute::TM_Attribute_Attribute
     * @access public
     */
    abstract public function getInstanceByArray(TM_Task_Task $task, $values);

    /**
     *
     *
     * @param TM_Task_Task $task
     * @return void array
     * @abstract
     * @access public
     */
    abstract public function getAllInstance(TM_Task_Task $task);

}
