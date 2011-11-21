<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 21.11.11
 * Time: 20:28
 * To change this template use File | Settings | File Templates.
 */
 
class TM_Attribute_AttributeTypeText extends TM_Attribute_AttributeType {

    public function getHTMLFrom($hash, $object)
    {
        $html = '<textarea name="data[attribute][' . $hash->attributeKey . ']" >';
        if ($object->searchAttribute($hash->attributeKey)) {
            $html .= $object->getAttribute($hash->attributeKey)->value;
        }
        $html .= '</textarea>';
        echo $html;
    }

}
