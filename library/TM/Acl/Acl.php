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
        $this->addResource(new Zend_Acl_Resource('admin_allow'), 'guest_allow');
        $this->addResource(new Zend_Acl_Resource('login/logout'), 'admin_allow');

        $this->addResource(new Zend_Acl_Resource('index/index'), 'admin_allow');

        $this->addResource(new Zend_Acl_Resource('user/index'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('user/add'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('user/edit'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('user/delete'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('user/addRole'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('user/editRole'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('user/deleteRole'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('user/addResource'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('user/editResource'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('user/deleteResource'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('user/fillResource'), 'admin_allow');

        $this->addResource(new Zend_Acl_Resource('task/index'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('task/add'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('task/edit'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('task/delete'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('task/addAttributeType'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('task/editAttributeType'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('task/deleteAttributeType'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('task/addAttributeHash'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('task/editAttributeHash'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('task/deleteAttributeHash'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('task/deleteLinkToDoc'), 'admin_allow');

        $this->addResource(new Zend_Acl_Resource('document/index'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('document/add'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('document/edit'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('document/delete'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('document/addFolder'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('document/editFolder'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('document/deleteFolder'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('document/addAttributeType'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('document/editAttributeType'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('document/deleteAttributeType'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('document/addAttributeHash'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('document/editAttributeHash'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('document/deleteAttributeHash'), 'admin_allow');

        $this->addResource(new Zend_Acl_Resource('discussion/index'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('discussion/add'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('discussion/edit'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('discussion/delete'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('discussion/addTopic'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('discussion/editTopic'), 'admin_allow');
        $this->addResource(new Zend_Acl_Resource('discussion/deleteTopic'), 'admin_allow');

        $this->addResource(new Zend_Acl_Resource('files/'), 'admin_allow');

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