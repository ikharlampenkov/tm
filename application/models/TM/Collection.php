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
    protected $mapper;
    protected $total = 0;
    protected $raw = array();

    private $_result;
    private $_pointer = 0;
    protected  $objects = array();

    /**
     *
     * @param array $raw
     * @param null  $mapper
     */
    public function __construct(array $raw = null, $mapper = null)
    {
        if (!is_null($raw) && !is_null($mapper)) {
            $this->raw = $raw;
            $this->total = count($raw);
        }
        $this->mapper = $mapper;
    }

    public function add($object)
    {
        $class = $this->targetClass();
        if (!($object instanceof $class)) {
            throw new Exception('This collection for ' . $class);
        }

        $this->notifyAccess();
        $this->objects[$this->total] = $object;
        $this->total++;
    }

    public abstract function targetClass();

    protected function notifyAccess()
    {

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
            $this->objects[$num] = $this->mapper->getInstanceByArray($this->raw[$num]);
            return $this->objects[$num];
        }

        return null;
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