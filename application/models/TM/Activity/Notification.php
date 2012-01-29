<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 29.01.12
 * Time: 22:43
 * To change this template use File | Settings | File Templates.
 */
class TM_Activity_Notification
{
    /**
     * @var TM_Activity_Notification
     */
    static private $_instance = null;

    /**
     * @var string
     */
    protected $_message = '';


    /**
     *
     * @var StdLib_DB
     * @access protected
     */
    protected $_db;

    public function __get($name)
    {
        $method = "get{$name}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }


    /**
     * @static
     * @return TM_Activity_Notification
     */
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
        $this->_db = StdLib_DB::getInstance();
    }


    public function sendMessage($message, TM_Task_Task &$object)
    {
        $email = '';
        try {
            if ($object->getUser()->searchAttribute('email')) {
                if ($object->getUser()->getAttribute('email')->getValue() != '') {
                    $email .= $object->getUser()->getAttribute('email')->getValue() . ', ';
                }
            }

            if ($object->searchAttribute('who_responsible')) {
                if ($object->getAttribute('who_responsible')->getValue() != '') {
                    $email .= $object->getAttribute('who_responsible')->getValue() . ', ';
                }
            }

            $aclList = TM_Acl_TaskAcl::getAllInstance($object);
            foreach ($aclList as $user_id => $acl) {
                if ($acl->getIsExecutant() == 1) {
                    $oUser = TM_User_User::getInstanceById($user_id);
                    if ($oUser->searchAttribute('email')) {
                        if ($oUser->getAttribute('email')->getValue() != '') {
                            $email .= $oUser->getAttribute('email')->getValue() . ', ';
                        }
                    }
                }
            }

            mail($email, 'Оповещения от TaskDrive', $message);
        } catch (Exception $e) {
            StdLib_Log::logMsg('Не могу разослать оповещение: ' . $message . ' для ' . $email . '. ' . $e->getMessage(), StdLib_Log::StdLib_Log_ERROR);
        }
    }

    //Создателю, ответственному, исполнителю, настроить оповещение всем кто имеет права.

}
