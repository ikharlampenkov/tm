<?php

class TM_Acl_Acl extends Zend_Acl {
    
    public function  __construct() {
        /*
        //Добавляем роли
        $this->addRole('guest');
        $this->addRole('user', 'guest');
        $this->addRole('admin', 'user');

        //Добавляем ресурсы
        // РЕСУРСЫ ГОСТЯ !
        $this->addResource(new Zend_Acl_Resource('test'));
        $this->add(new Zend_Acl_Resource('guest_allow'));
        $this->add(new Zend_Acl_Resource('index/index'),'guest_allow');
        //...

        // РЕСУРСЫ ПОЛЬЗОВАТЕЛЯ !
        $this->add(new Zend_Acl_Resource('user_allow'));
        $this->add(new Zend_Acl_Resource('user/index'), 'user_allow');
        // ...

        // РЕСУРСЫ АДМИНА !
        $this->add(new Zend_Acl_Resource('admin_allow'));
        $this->add(new Zend_Acl_Resource('admin/index'), 'admin_allow');
        //...

        //Выставляем права, по-умолчанию всё запрещено
        $this->deny(null, null, null);
        $this->allow('guest', 'guest_allow', 'show');
        $this->allow('user', 'user_allow', 'show');
        $this->allow('admin','admin_allow', 'show');
        */

        $this->allow(null, null, null);
    }

    public function can($privilege = 'show'){
        //Инициируем ресурс
        $request = Zend_Controller_Front::getInstance()->getRequest();
        $resource = $request->getControllerName() . '/' . $request->getActionName();
        //Если ресурс не найден закрываем доступ
        if (!$this->has($resource))
            return true;
        //Инициируем роль
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $role = array_key_exists('status', $storage_data)?$storage_data->status : 'guest';
        return $this->isAllowed($role, $resource, $privilege);
    }
}

?>