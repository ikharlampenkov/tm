<?php

//task_id, attribute_key, type_id, attribute_value


/**
 * class TM_Task_Attribute
 *
 */
class TM_Organization_AttributeMapper extends TM_Attribute_AttributeMapper
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     *
     * @param TM_Attribute_Attribute $attribute
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function insertToDb(TM_Attribute_Attribute $attribute)
    {
        try {
            if (!empty($attribute->value)) {
                $isFill = 1;
            } else {
                $isFill = 0;
            }

            $sql
                = 'REPLACE INTO tm_organization_attribute(organization_id, attribute_key, type_id, attribute_value, attribute_order, is_fill)
                    VALUES (' . $attribute->getObject()->getId() . ', "' . $attribute->attributeKey . '", ' . $attribute->type->getId() . ',
                           "' . $attribute->value . '", ' . $attribute->attributeOrder . ', ' . $isFill . ')';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     * @param \TM_Attribute_Attribute $attribute
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function updateToDb(TM_Attribute_Attribute $attribute)
    {
        try {
            if (!empty($attribute->value)) {
                $isFill = 1;
            } else {
                $isFill = 0;
            }

            $sql
                = 'UPDATE tm_organization_attribute
                    SET type_id="' . $attribute->type->getId() . '", attribute_value="' . $attribute->value . '",
                        attribute_order=' . $attribute->attributeOrder . ', is_fill=' . $isFill . '
                    WHERE organization_id=' . $attribute->getObject()->getId() . ' AND attribute_key="' . $attribute->attributeKey . '"';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param TM_Attribute_Attribute $attribute
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function deleteFromDb(TM_Attribute_Attribute $attribute)
    {
        try {
            $sql
                = 'DELETE FROM tm_organization_attribute
                    WHERE organization_id=' . $attribute->getObject()->getId() . ' AND attribute_key="' . $attribute->attributeKey . '"';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param        $object
     * @param string $key
     *
     * @throws Exception
     * @return TM_Attribute_Attribute
     * @static
     * @access public
     */
    public function getInstanceByKey($object, $key)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_organization_attribute WHERE organization_id=' . $object->getId() . ' AND attribute_key="' . $key . '"';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Attribute_Attribute($object);
                $o->fillFromArray($result[0]);
                return $o;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param $object
     *
     * @throws Exception
     * @return array
     * @static
     * @access public
     */
    public function getAllInstance($object)
    {
        try {
            $sql = 'SELECT * FROM tm_organization_attribute WHERE organization_id=' . $object->getId();
            return new TM_Attribute_AttributeDeferredCollection($object, $sql, $this);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    /**
     *
     * @param       $object
     * @param array $values
     *
     * @throws Exception
     * @return TM_Attribute_Attribute
     * @access public
     */
    public function getInstanceByArray($object, $values)
    {
        try {
            $o = new TM_Attribute_Attribute($object);
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}