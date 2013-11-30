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
class TM_Attribute_AttributeCollection extends TM_AssocCollection
{
    private $_object = null;

    public function __construct($object = null, array $raw = null, $mapper = null)
    {
        parent::__construct($raw, $mapper);

        $this->_object = $object;
    }

    public function targetClass()
    {
        return 'TM_Attribute_Attribute';
    }

    /**
     * @param $num
     * @return TM_Attribute_Attribute|null
     */
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
            $this->objects[$key] = $this->mapper->getInstanceByArray($this->_object, $this->raw[$key]);
            return $this->objects[$key];
        }

        return null;
    }

    /**
     * @param $key
     * @return TM_Attribute_Attribute|null
     */
    public function at($key)
    {
        $this->notifyAccess();
        if (!in_array($key, $this->keys)) {
            return null;
        }

        if (isset($this->objects[$key])) {
            return $this->objects[$key];
        }

        if (isset($this->raw[$key])) {
            $this->objects[$key] = $this->mapper->getInstanceByArray($this->_object, $this->raw[$key]);
            return $this->objects[$key];
        }

        return null;
    }

    public function search($key)
    {
        $this->notifyAccess();
        return in_array($key, $this->keys);
    }

    public function getTotal()
    {
        $this->notifyAccess();
        return $this->total;
    }
}