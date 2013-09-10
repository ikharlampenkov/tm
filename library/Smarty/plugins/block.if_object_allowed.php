<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 27.11.11
 * Time: 20:18
 * To change this template use File | Settings | File Templates.
 */


/**
 * @param                          $params
 * @param                          $content
 * @param Smarty_Internal_Template $template
 * @param                          $repeat
 *
 * @internal param $smarty
 * @return bool
 */
function smarty_block_if_object_allowed($params, $content, Smarty_Internal_Template $template, &$repeat)
{
    if (!$repeat) {
        if (isset($content)) {

            //Инициируем роль
            $storage_data = Zend_Auth::getInstance()->getStorage()->read();
            $user = $storage_data->id;
//|| $storage_data->role === 'adminsystem'
            if ($storage_data->role === 'admin' || $storage_data->role === 'adminsystem') {
                return $content;
            }

            $class = 'TM_Acl_' . $params['type'] . 'Acl';

            if (class_exists($class)) {

                $aclList = call_user_func($class . '::getAllInstance', $params['object'], $user);

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
                        } elseif ($privilege == 'executant' && $aclList[$user]->getIsExecutant()) {
                            //throw new Exception('444');
                            return $content;
                        } else {
                            //throw new Exception('555');
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