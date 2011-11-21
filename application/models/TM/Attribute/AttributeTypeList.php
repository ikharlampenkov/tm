<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 21.11.11
 * Time: 21:25
 * To change this template use File | Settings | File Templates.
 */

class TM_Attribute_AttributeTypeList extends TM_Attribute_AttributeType
{

    public function getHTMLFrom($hash, $object)
    {
        $html = '<select name="data[attribute][' . $hash->attributeKey . ']" >';

        foreach ($hash->getValueList() as $value) {
            $html .= '<option value="' . $value . '" ';
            if ($object->searchAttribute($hash->attributeKey)) {
                if ($object->getAttribute($hash->attributeKey)->value == $value) {
                    $html .= 'selected="selected"';
                }
            }
            $html .= '>' . $value . '</option>';
        }

        $html .= '</select>';
        echo $html;
    }

}
