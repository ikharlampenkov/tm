<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 29.01.12
 * Time: 23:08
 * To change this template use File | Settings | File Templates.
 */
class TM_Activity_ActivityLogger
{
    static public function logMessage(TM_User_User $user, $razdel, $message, &$object)
    {
        $oActivity = new TM_Activity_Activity();
        $oActivity->setDate(date('Y-m-d H:i:s'));
        $oActivity->setUser($user);
        $oActivity->setRazdel($razdel);
        $oActivity->setMessage($message);

        try {
            $oActivity->insertToDb();

            if ($object instanceof TM_Task_Task) {
                $oNotice = TM_Activity_Notification::getInstance();
                $oNotice->sendMessage($oActivity->getFullMessage(), $object);
            }
        } catch (Exception $e) {
            StdLib_Log::logMsg('Не могу сделать запись об активности. ' . $e->getMessage(), StdLib_Log::StdLib_Log_ERROR);
            throw new Exception('Не могу сделать запись об активности. ' . $e->getMessage());
        }
    }

}
