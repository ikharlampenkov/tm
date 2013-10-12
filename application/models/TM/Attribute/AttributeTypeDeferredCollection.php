<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 12.10.13
 * Time: 21:40
 * To change this template use File | Settings | File Templates.
 */

class TM_Attribute_AttributeTypeDeferredCollection extends TM_Attribute_AttributeTypeCollection
{
    /**
     * @var bool флаг исполнения SQL запроса
     */
    private $_run = false;

    /**
     * @var string SQL запрос
     */
    private $_sql;

    public function __construct($sql, $mapper = null)
    {
        parent::__construct(null, $mapper);

        $this->_sql = $sql;
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