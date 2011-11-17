<?php

class TM_Acl_Acl extends Zend_Acl {
    
    public function  __construct() {

        //Добавляем роли
        $this->addRole('guest');
        $this->addRole('admin', 'guest');

        //Добавляем ресурсы
        // РЕСУРСЫ ГОСТЯ !
        $this->addResource(new Zend_Acl_Resource('guest_allow'));
        $this->addResource(new Zend_Acl_Resource('login'), 'guest_allow');
        $this->addResource(new Zend_Acl_Resource('login/index'), 'guest_allow');
        //...

        /*
        // РЕСУРСЫ ПОЛЬЗОВАТЕЛЯ !
        $this->addResource(new Zend_Acl_Resource('user_allow'));
        $this->addResource(new Zend_Acl_Resource('user/index'), 'user_allow');
        // ...
        */

        // РЕСУРСЫ АДМИНА !
        $this->addResource(new Zend_Acl_Resource('admin_allow'));
        $this->addResource(new Zend_Acl_Resource('login/logout'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('index/index'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('user/index'), 'admin_allow');

        //...

        /*
        //Выставляем права, по-умолчанию всё запрещено
        $this->deny(null, null, null);
        $this->allow('guest', 'guest_allow', 'show');
        $this->allow('user', 'user_allow', 'show');
        $this->allow('admin','admin_allow', 'show');
        */

        $this->deny(null, null, null);
        $this->allow('guest', 'guest_allow', 'show');
        $this->allow('admin', 'admin_allow', array('show', 'read', 'write', 'delete'));
        $this->allow('admin', null, array('show', 'read', 'write', 'delete'));



    }

    public function can($privilege = 'show'){
        //Инициируем ресурс
        $request = Zend_Controller_Front::getInstance()->getRequest();
        $resource = $request->getControllerName() . '/' . $request->getActionName();

        //StdLib_Log::logMsg(' resource ' . $resource . ' priv ' . $privilege);

        //Если ресурс не найден закрываем доступ
        if (!$this->has($resource)) {
            return false;
        }

        //Инициируем роль
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $role = array_key_exists('role', $storage_data)?$storage_data->role : 'guest';

        //StdLib_Log::logMsg('role ' . $role . ' resource ' . $resource . ' priv ' . $privilege);

        return $this->isAllowed($role, $resource, $privilege);
    }
}

?>