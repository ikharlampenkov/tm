<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 13.11.11
 * Time: 21:50
 * To change this template use File | Settings | File Templates.
 */

class TM_User_UserManager
{

    static private $_instance = null;

    private $_db;

    static function getInstance()
    {
        if (is_null(self::$_instance)) {
            $class = __CLASS__;
            self::$_instance = new $class();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        $this->_db = simo_db::getInstance();
    }

    public function logIn($login, $password)
    {
        try {
            $o_user = TM_User_User::getInstanceByLogin($login);

            if ($o_user->getPassword === $password) {
                simo_session::setVar('id', $o_user->getId(), 'user');
                simo_session::setVar('login', $o_user->getLogin(), 'user');
                simo_session::setVar('token', md5($o_user->getPassword()), 'user');
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception("Can`t login");
        }
    }

    public function isLogin()
    {
        if (simo_session::existVar('id', 'user') && simo_session::existVar('login', 'user') && simo_session::existVar('token', 'user')) {
            $o_user = TM_User_User::getInstanceById(simo_session::getVar('id', 'user'));
            if (md5($o_user->getPassword()) === simo_session::getVar('token', 'user')) {
                return true;
            } else
                return false;
        } else
            return false;
    }

    public function logOut()
    {
        simo_session::clearVars('user');
    }

    public function getUser()
    {
        if (simo_session::existVar('login', 'user')) {
            $o_user = TM_User_User::getInstanceById('id');
            return $o_user;
        } else {
            return false;
        }
    }


}
