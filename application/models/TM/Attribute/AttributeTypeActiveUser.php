<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Никита
 * Date: 04.12.11
 * Time: 16:56
 * To change this template use File | Settings | File Templates.
 */
class TM_Attribute_AttributeTypeActiveUser extends TM_Attribute_AttributeType
{

    public function getHTMLFrom($hash, $object)
    {
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $user = array_key_exists('login', $storage_data) ? $storage_data->login : 'guest';
        $oUser = TM_User_User::getInstanceByLogin($user);


        $html = '<input type="checkbox" name="data[attribute][' . $hash->attributeKey . ']" value="' . $user . ' "';

        if ($object->searchAttribute($hash->attributeKey)) {
            if ($object->getAttribute($hash->attributeKey)->value !== '') {
                $html .= 'checked="checked"';
            }
        }

        $html .= ' style="width: 14px;" ';
        if ($object->searchAttribute($hash->attributeKey)) {
            if ($object->getAttribute($hash->attributeKey)->value !== '') {
                if ($object->getAttribute($hash->attributeKey)->value != $user) {
                    $html .= ' disabled="disabled" ';
                }
                $html .= ' /> ';
                $oUserTemp = TM_User_User::getInstanceByLogin($object->getAttribute($hash->attributeKey)->value);
                if ($oUserTemp->searchAttribute('name')) {
                    $html .= $oUserTemp->getAttribute('name')->value;
                } else {
                    $html .= $oUserTemp->login;
                }
            }
        } else {
            $html .= ' /> ';

            if ($oUser->searchAttribute('name')) {
                $html .= $oUser->getAttribute('name')->value;
            } else {
                $html .= $oUser->login;
            }
        }
        echo $html;
    }
}
