<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Никита
 * Date: 04.12.11
 * Time: 16:56
 * To change this template use File | Settings | File Templates.
 */
class TM_Attribute_AttributeTypeUserList extends TM_Attribute_AttributeType
{

    public function getHTMLFrom($hash, $object)
    {
        $html =  '<select name="data[attribute][' . $hash->attributeKey . ']" >';
        $html .= '<option value="-">-</option> ';

        foreach (TM_User_User::getAllInstance() as $value) {
            $html .= '<option value="' . $value->id . '" ';
            if ($object->searchAttribute($hash->attributeKey)) {
                if ($object->getAttribute($hash->attributeKey)->value == $value->id) {
                    $html .= 'selected="selected"';
                }
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
