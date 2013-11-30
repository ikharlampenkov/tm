<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 19.11.11
 * Time: 14:38
 * To change this template use File | Settings | File Templates.
 */

class TM_Organization_Hash extends TM_Attribute_Hash
{

    /**
     * @var TM_Organization_Organization
     * @access protected
     */
    protected $_organization;

    /**
     *
     *
     * @return TM_Organization_Organization
     * @access public
     */
    public function getOrganization()
    {
        return $this->_organization;
    }

    /**
     *
     *
     * @param TM_Organization_Organization $value
     * @return void
     * @access protected
     */
    protected function setOrganization(TM_Organization_Organization $value)
    {
        $this->_organization = $value;

    }

    /**
     *
     *
     * @return TM_Organization_Hash
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function insertToDb()
    {
        try {
            $sql = 'INSERT INTO tm_organization_hash(organization_id, attribute_key, title, type_id, list_value, list_order, required, sort_order)
                    VALUES (NULL, "' . $this->_attributeKey . '", "' . $this->_title . '", ' . $this->_type->getId() . ',
                            "' . $this->_listValue . ' ", "' . $this->_listOrder . '",  ' . $this->_prepareBool($this->_isRequired) . ', ' . $this->_sortOrder . ')';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function updateToDb()
    {
        try {
            $sql = 'UPDATE tm_organization_hash
                    SET title="' . $this->_title . '", type_id=' . $this->_type->getId() . ',
                        list_value="' . $this->_listValue . ' ", list_order="' . $this->_listOrder . '",
                        required=' . $this->_prepareBool($this->_isRequired) . ', sort_order=' . $this->_sortOrder . '
                    WHERE organization_id IS NULL AND attribute_key="' . $this->_attributeKey . '"';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @throws Exception
     * @return void
     * @access public
     */
    public function deleteFromDb()
    {
        try {
            $sql = 'DELETE FROM tm_organization_hash
                    WHERE organization_id IS NULL AND attribute_key="' . $this->_attributeKey . '"';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int $key идентификатор задачи
     * @throws Exception
     * @return TM_Organization_Hash
     * @static
     * @access public
     */
    public static function getInstanceById($key)
    {
        try {
            $db = StdLib_DB::getInstance();
            $sql = 'SELECT * FROM tm_organization_hash WHERE organization_id IS NULL AND attribute_key="' . $key . '"';
            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Organization_Hash();
                $o->fillFromArray($result[0], new TM_Organization_AttributeTypeMapper());
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
     * @param array $values
     * @throws Exception
     * @return TM_Organization_Hash
     * @static
     * @access public
     */
    public static function getInstanceByArray($values)
    {
        try {
            $o = new TM_Organization_Hash();
            $o->fillFromArray($values, new TM_Organization_AttributeTypeMapper());
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     * @param $object
     * @throws Exception
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance($object = null)
    {
        try {
            $db = StdLib_DB::getInstance();

            $sql = 'SELECT tm_organization_hash.attribute_key, title, tm_organization_hash.type_id, list_value, list_order, required, sort_order
                    FROM tm_organization_hash ';

            if (!is_null($object)) {
                $sql .= ' LEFT JOIN (
                        SELECT * FROM tm_organization_attribute WHERE tm_organization_attribute.organization_id=' . $object->id . '
                    ) t2 ON tm_organization_hash.attribute_key=t2.attribute_key
                    ORDER BY required DESC, sort_order, title';
            } else {
                $sql .= ' ORDER BY required DESC, sort_order, title';
            }

            $result = $db->query($sql, StdLib_DB::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Organization_Hash::getInstanceByArray($res);
                }
                return $retArray;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
