<?php

/**
 * class ProductCatalog
 *
 */
class ProductCatalog {
    /** Aggregations: */

    /** Compositions: */
    /*     * * Attributes: ** */

    private $_db;

    public function __construct() {
        $this->_db = simo_db::getInstance();
    }

    public function getAllRubric($parent) {
        try {
            $result = $this->_db->query('SELECT * FROM product_rubric WHERE parent_id=' . $parent, simo_db::QUERY_MOD_ASSOC);
            if (isset($result[0])) {
                $rubricArray = array();
                foreach ($result as $value) {
                    $rubricArray[] = Rubric::getInstanceByArray($value);
                }
                return $rubricArray;
            }
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
            return false;
        }
    }

    public function getRubricTree() {
        $tree = array();

        $root = Rubric::getRootRubric();
        $tree[] = $root;

        $this->_getSubRubricTree($root->id, $tree);
        return $tree;
    }

    private function _getSubRubricTree($parent, &$tree) {
        $result = $this->_db->query('SELECT * FROM product_rubric WHERE parent_id=' . $parent, simo_db::QUERY_MOD_ASSOC);
        if (isset($result[0])) {
            foreach ($result as $res) {
                $rubric = Rubric::getInstanceByArray($res);
                $tree[] = $rubric;
                $this->_getSubRubricTree($rubric->id, $tree);
            }
        } else
            return false;
    }

    public function getAllProduct($rubric_id) {
        try {
            $result = $this->_db->query('SELECT * FROM product WHERE product_rubric_id=' . $rubric_id, simo_db::QUERY_MOD_ASSOC);
            if (isset($result[0])) {
                $productArray = array();
                foreach ($result as $value) {
                    $productArray[] = Product::getInstanceByArray($value);
                }
                return $productArray;
            } else
                return false;
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
            return false;
        }
    }

    public function getAllOrder() {
        try {
            $result = $this->_db->query('SELECT * FROM `order` ORDER BY is_complite, date DESC', simo_db::QUERY_MOD_ASSOC);
            if (isset($result[0])) {
                $orderArray = array();
                foreach ($result as $value) {
                    $orderArray[] = Order::getInstanceByArray($value);
                }
                return $orderArray;
            } else
                return false;
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
            return false;
        }
    }

    public function getAllOrderByUser($login) {
        try {
            $result = $this->_db->query('SELECT * FROM `order` WHERE user_login="' . $login . '" ORDER BY is_complite, date DESC', simo_db::QUERY_MOD_ASSOC);
            if (isset($result[0])) {
                $orderArray = array();
                foreach ($result as $value) {
                    $orderArray[] = Order::getInstanceByArray($value);
                }
                return $orderArray;
            } else
                return false;
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
            return false;
        }
    }

}

// end of ProductCatalog
?>