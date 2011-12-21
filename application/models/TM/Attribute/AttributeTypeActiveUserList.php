<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Никита
 * Date: 04.12.11
 * Time: 16:56
 * To change this template use File | Settings | File Templates.
 */
class TM_Attribute_AttributeTypeActiveUserList extends TM_Attribute_AttributeType
{

    public function getHTMLFrom($hash, $object)
    {
        $storage_data = Zend_Auth::getInstance()->getStorage()->read();
        $userId = array_key_exists('id', $storage_data) ? $storage_data->id : 0;
        //$oUser = TM_User_User::getInstanceById($user);

        $html =  '<select name="data[attribute][' . $hash->attributeKey . ']" >';
        $html .= '<option value="-">-</option> ';

        foreach (TM_User_User::getAllInstance() as $value) {
            $html .= '<option value="' . $value->id . '" ';
            if ($object->searchAttribute($hash->attributeKey)) {
                if ($object->getAttribute($hash->attributeKey)->value == $value->id) {
                    $html .= 'selected="selected"';
                }
            } elseif ($value->id == $userId) {
                $html .= 'selected="selected"';
            }


            $html .= '>';
            if ($value->searchAttribute('name')) {
                $html .= $value->getAttribute('name')->value;
            } else {
                $html .= $value->login;
            }
            $html .= '</option>';
        }

        $html .= '</select>';
        echo $html;
    }
}
