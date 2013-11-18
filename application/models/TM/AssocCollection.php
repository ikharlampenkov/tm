<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 10.10.13
 * Time: 22:17
 * To change this template use File | Settings | File Templates.
 */

abstract class TM_AssocCollection implements Iterator
{
    protected $mapper;
    protected $total = 0;
    protected $raw = array();
    protected $keys = array();

    private $_result;
    private $_pointer = 0;
    protected $objects = array();

    /**
     *
     * @param array $raw
     * @param null $mapper
     */
    public function __construct(array $raw = null, $mapper = null)
    {
        if (!is_null($raw) && !is_null($mapper)) {
            $this->raw = $raw;
            $this->keys = array_keys($raw);
            $this->total = count($raw);
        }
        $this->mapper = $mapper;
    }

    public function add($key, $object)
    {
        $class = $this->targetClass();
        if (!($object instanceof $class)) {
            throw new Exception('This collection for ' . $class);
        }

        $this->notifyAccess();

        if (array_key_exists($key, $this->keys)) {
            throw new Exception('Key ' . $key . ' already exist');
        }
        $this->objects[$key] = $object;
        $this->keys[$this->total] = $key;
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

        if (!isset($this->keys[$num])) {
            return null;
        } else {
            $key = $this->keys[$num];
        }

        if (isset($this->objects[$key])) {
            return $this->objects[$key];
        }

        if (isset($this->raw[$key])) {
            $this->objects[$key] = $this->mapper->getInstanceByArray($this->raw[$key]);
            return $this->objects[$key];
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