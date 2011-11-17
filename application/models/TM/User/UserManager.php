<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 13.11.11
 * Time: 21:50
 * To change this template use File | Settings | File Templates.
 */

class TM_User_UserManager implements Zend_Auth_Adapter_Interface
{

    static private $_instance = null;

    protected $_db;

    protected $_login;
    protected $_password;

    static function getInstance()
    {
        if (is_null(self::$_instance)) {
            $class = __CLASS__;
            self::$_instance = new $class();
        }
        return self::$_instance;
    }

    public function setLogin($login)
    {
        $this->_login = $login;
    }

    public function getLogin()
    {
        return $this->_login;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    private function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
    }

    public function logIn($login, $password)
    {
        try {
            $o_user = TM_User_User::getInstanceByLogin($login);

            if ($o_user->getPassword === $password) {
                StdLib_Session::setVar('id', $o_user->getId(), 'user');
                StdLib_Session::setVar('login', $o_user->getLogin(), 'user');
                StdLib_Session::setVar('token', md5($o_user->getPassword()), 'user');
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
        if (StdLib_Session::existVar('id', 'user') && StdLib_Session::existVar('login', 'user') && StdLib_Session::existVar('token', 'user')) {
            $o_user = TM_User_User::getInstanceById(StdLib_Session::getVar('id', 'user'));
            if (md5($o_user->getPassword()) === StdLib_Session::getVar('token', 'user')) {
                return true;
            } else
                return false;
        } else
            return false;
    }

    public function logOut()
    {
        StdLib_Session::clearVars('user');
    }

    public function getUser()
    {
        if (StdLib_Session::existVar('login', 'user')) {
            $o_user = TM_User_User::getInstanceById('id');
            return $o_user;
        } else {
            return false;
        }
    }


    /**
     * Performs an authentication attempt
     *
     * @throws Zend_Auth_Adapter_Exception If authentication cannot be performed
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
       try {
            $o_user = TM_User_User::getInstanceByLogin($this->_login);

            if ($o_user !== false && $o_user->getPassword() == $this->_password) {
                StdLib_Session::setVar('id', $o_user->getId(), 'user');
                StdLib_Session::setVar('login', $o_user->getLogin(), 'user');
                StdLib_Session::setVar('token', md5($o_user->getPassword()), 'user');

                $identity = new stdClass();
                $identity->id = $o_user->getId();
                $identity->login = $o_user->getLogin();
                $identity->token = md5($o_user->getPassword());
                $identity->role = $o_user->getRole()->getTitle();

                $result = new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $identity); //$o_user
            } else {
                $result = new Zend_Auth_Result(Zend_Auth_Result::FAILURE, null, array('loginFailed' => 'Incorrect Login & Password'));
            }

            return $result;
        } catch (Exception $e) {
            throw new Zend_Auth_Adapter_Exception("Can`t login. " . $e->getMessage());
        }
    }
}
