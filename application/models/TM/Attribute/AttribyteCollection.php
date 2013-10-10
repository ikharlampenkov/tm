<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 10.10.13
 * Time: 22:42
 * To change this template use File | Settings | File Templates.
 */

/**
 * Class TM_Attribute_AttribyteCollection
 */
class TM_Attribute_AttribyteCollection extends TM_Collection
{

    private $_run = false;

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
}