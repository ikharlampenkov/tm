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
class TM_Attribute_AttributeCollection extends TM_Collection
{
    private $_object = null;

    private $_run = false;

    public function __construct($object = null, array $raw = null, $mapper = null)
    {
        parent::__construct($raw, $mapper);

        $this->_object = $object;
    }

    public function targetClass()
    {
        return 'TM_Attribute_Attribute';
    }


    protected function notifyAccess()
    {
        if (!$this->_run) {
            //$this->raw = $this->mapper->
        }
        $this->_run = true;

    }

    protected function _getRow($num)
    {
        $this->notifyAccess();
        if ($num >= $this->total || $num < 0) {
            return null;
        }

        if (isset($this->objects[$num])) {
            return $this->objects[$num];
        }

        if (isset($this->raw[$num])) {
            $this->objects[$num] = $this->mapper->getInstanceByArray($this->_object, $this->raw[$num]);
            return $this->objects[$num];
        }
    }
}