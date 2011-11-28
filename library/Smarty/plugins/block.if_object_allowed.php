<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 27.11.11
 * Time: 20:18
 * To change this template use File | Settings | File Templates.
 */


/**
 * @param $params
 * @param $content
 * @param $smarty
 * @param $repeat
 * @return
 */
function smarty_block_if_object_allowed($params, $content, &$smarty, &$repeat)
{
    if (!$repeat) {
        if (isset($content)) {

            //Инициируем роль
            $storage_data = Zend_Auth::getInstance()->getStorage()->read();
            $user = $storage_data->id;

            if ($storage_data->role === 'admin') {
                return $content;
            }

            $class = 'TM_Acl_' . $params['type'] . 'Acl';
            if (class_exists($class)) {
                $aclList = $class::getAllInstance($params['object']);

                if (empty($aclList)) {
                    return false;
                } else {
                    $privilege = 'read';
                    if (isset($params['priv'])) {
                        $privilege = $params['priv'];
                    }



                    if (array_key_exists($user, $aclList)) {
                        if ($privilege == 'read' && $aclList[$user]->getIsRead()) {
                            return $content;
                        } elseif ($privilege == 'write' && $aclList[$user]->getIsWrite()) {
                            return $content;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
    }
}