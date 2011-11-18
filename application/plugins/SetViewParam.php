<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 17.11.11
 * Time: 21:37
 * To change this template use File | Settings | File Templates.
 */
 
class SetViewParam extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch() {
        $view = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('View');
        $view->assign('controller', Zend_Controller_Front::getInstance()->getRequest()->getControllerName());
    }

}
