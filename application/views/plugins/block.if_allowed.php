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
function smarty_block_if_allowed($params, $content, &$smarty, &$repeat) {
    if (! $repeat) {
        if (isset($content)) {
            $acl = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('acl');
            $privilege = 'show';

            if (isset($params['priv'])) {
                $privilege = $params['priv'];
            }

            if ($acl->canResource($params['resource'], $privilege)) {
                return $content;
            }
        }
    }
}