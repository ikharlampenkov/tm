<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 10.10.13
 * Time: 22:17
 * To change this template use File | Settings | File Templates.
 */

abstract class TM_Collection implements Iterator
{
    protected $object = null;

    protected $mapper;
    protected $total = 0;
    protected $raw = array();

    private $_result;
    private $_pointer = 0;
    private $_objects = array();

    /**
     * @param null  $object
     * @param array $raw
     * @param null  $mapper
     */
    public function __construct($object = null, array $raw = null, $mapper = null)
    {
        if (!is_null($raw) && !is_null($mapper)) {
            $this->raw = $raw;
            $this->total = count($raw);
        }
        $this->mapper = $mapper;
        $this->object = $object;
    }

    public function add($object)
    {
        $class = $this->targetClass();
        if (!($object instanceof $class)) {
            throw new Exception('This collection for ' . $class);
        }

        $this->notifyAccess();
        $this->_objects[$this->total] = $object;
        $this->total++;
    }

    public abstract function targetClass();

    protected function notifyAccess()
    {

    }

    private function _getRow($num)
    {
        $this->notifyAccess();
        if ($num >= $this->total || $num < 0) {
            return null;
        }

        if (isset($this->_objects[$num])) {
            return $this->_objects[$num];
        }

        if (isset($this->raw[$num])) {
            $this->_objects[$num] = $this->mapper->getInstanceByArray($this->object, $this->raw[$num]);
            return $this->_objects[$num];
        }
    }

    public function rewind()
    {
        $this->_pointer = 0;
    }

    public function current()
    {
        return $this->_getRow($this->_pointer);
    }

    public function key()
    {
        return $this->_pointer;
    }

    public function next()
    {
        $row = $this->_getRow($this->_pointer);
        if ($row) {
            $this->_pointer++;
        }
        return $row;
    }

    public function valid()
    {
        return (!is_null($this->current()));
    }
}