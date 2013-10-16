<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 10.10.13
 * Time: 22:42
 * To change this template use File | Settings | File Templates.
 */

/**
 * Class TM_Attribute_AttributeCollection
 */
class TM_Attribute_AttributeDeferredCollection extends TM_Attribute_AttributeCollection
{
    private $_sql = '';

    private $_run = false;

    public function __construct($object = null, $sql, $mapper = null)
    {
        parent::__construct($object, null, $mapper);
        $this->_sql = $sql;
    }

    public function targetClass()
    {
        return 'TM_Attribute_Attribute';
    }


    protected function notifyAccess()
    {
        if (!$this->_run) {
            $db = StdLib_DB::getInstance();
            $this->raw = $db->query($this->_sql, StdLib_DB::QUERY_MOD_ASSOC);
            $this->total = count($this->raw);
        }
        $this->_run = true;

    }
}