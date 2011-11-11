<?php

require_once 'Attribute/TM_Attribute_AttributeType.php';


/**
 * class TM_Document_AttribyteType
 * 
 */
class TM_Document_AttributeType extends TM_Attribute_AttributeType
{

    /** Aggregations: */

    /** Compositions: */

     /*** Attributes: ***/


    public function __construct() {
       parent::__construct();
        
    }

    /**
     *
     *

     * @return void
       @access public
     */
    public function insertToDB()
    {
        try {
            $sql = 'INSERT INTO tm_document_attribute_type(id, title, `handler`, description)
                    VALUES (' . $this->_id . ', "' . $this->_title . '", "' . $this->_handler . '", "' . $this->_description  . '")';
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    /**
     *
     *
     * @return void
     * @access public
     */
    public function updateToDB()
    {
        try {
            $sql = 'UPDATE tm_document_attribute_type
                    SET title="' . $this->_title . '", `handler`="' . $this->_handler . '", description="' . $this->_description  . '"
                    WHERE id=' .  $this->_id ;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @return
     * @access public
     */
    public function deleteFromDB()
    {
        try {
            $sql = 'DELETE FROM tm_document_attribute_type WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     *
     *
     * @param int id

     * @return Attribute::TM_Attribute_AttributeType
     * @static
     * @access public
     */
    public static function getInstanceById($id)
    {
        try {
           $db = simo_db::getInstance();
            $sql = 'SELECT * FROM tm_document_attribute_type WHERE id=' . (int)$id;
            $result = $db->query($sql, simo_db::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $o = new TM_Document_AttributeType();
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
     * @return array
     * @static
     * @access public
     */
    public static function getAllInstance()
    {
        try {
            $db = simo_db::getInstance();
            $sql = 'SELECT * FROM tm_document_attribute_type';
            $result = $db->query($sql, simo_db::QUERY_MOD_ASSOC);

            if (isset($result[0])) {
                $retArray = array();
                foreach ($result as $res) {
                    $retArray[] = TM_Document_AttributeType::getInstanceByArray($res);
                }
                return $retArray;
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
     * @param array values

     * @return Attribute::TM_Attribute_Attribute
     * @static
     * @access public
     */
    public static function getInstanceByArray($values)
    {
        try {
            $o = new TM_Document_AttributeType();
            $o->fillFromArray($values);
            return $o;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
} // end of TM_Document_AttribyteType
?>
