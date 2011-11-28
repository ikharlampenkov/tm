<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 26.11.11
 * Time: 13:27
 * To change this template use File | Settings | File Templates.
 */
 
class TM_Attribute_AttributeTypeDate extends TM_Attribute_AttributeType {
    
    /**
     * @param $hash
     * @param $object
     * @return void
     */
    public function getHTMLFrom($hash, $object)
    {
        $html = '<input name="data[attribute][' . $hash->attributeKey . ']" value="';
        if ($object->searchAttribute($hash->attributeKey)) {
            $html .= date('d.m.Y H:i:s', strtotime($object->getAttribute($hash->attributeKey)->value));
        } else {
            $html .= date('d.m.Y H:i:s');
        }
        $html .= '"/>';
        echo $html;
    }

}
