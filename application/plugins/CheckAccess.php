<?php

class CheckAccess extends Zend_Controller_Plugin_Abstract
{
    /**
     * Метод preDispatch выполняет проверку прав доступа на
     * данный controller/action в случае ошибки вызывает метод
     * generateAccessError
     *
     * @param Zend_Controller_Request_Abstract $request
     */
    public function  preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $acl = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('acl');
        if (!$acl->can()) {
            $this->generateAccessError();
        }
    }

    /**
     * Метод генерации сообщения о ошибке прав доступа.
     * Выполняет перенаправление на контроллер error и выводит в нём
     * сообщение о ошибке передаваемое в метод.
     *
     * @param string $msg
     */
    public function generateAccessError($msg = 'Доступ запрещён!')
    {
        $request = $this->getRequest();
        $request->setControllerName('error');
        $request->setActionName('error');
        $request->setParam('message', $msg);
    }
}

?>