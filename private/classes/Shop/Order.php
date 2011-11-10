<?php

/*
  CREATE  TABLE IF NOT EXISTS `eshop`.`order` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_login` VARCHAR(10) NOT NULL ,
  `date` DATETIME NOT NULL ,
  `discount` DECIMAL(12,2) NULL ,
  `is_complite` TINYINT(1)  NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_order_user1` (`user_login` ASC) ,
  CONSTRAINT `fk_order_user1`
  FOREIGN KEY (`user_login` )
  REFERENCES `eshop`.`user` (`login` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
  ENGINE = InnoDB
 */

/**
 * class Order
 *
 */
class Order {
    /** Aggregations: */

    /** Compositions: */
    /*     * * Attributes: ** */
    
    const NEW_ORDER = 1;

    protected $_id;
    protected $_user;
    protected $_date;
    protected $_discount = 0;
    protected $_isComplite = 0;
    protected $_productList = array();
    protected $_status = null;
    private $_db;

    public function __construct() {
        $this->_db = simo_db::getInstance();
        $this->setStatus(Order::NEW_ORDER);
    }

    public function __get($name) {
        $method = "get{$name}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

    public function getId() {
        return $this->_id;
    }

    public function getUser() {
        return $this->_user;
    }

    public function getDate() {
        return $this->_date;
    }

    public function getDiscount() {
        return $this->_discount;
    }

    public function getIsComplite() {
        return $this->_isComplite;
    }

    public function getProductList() {
        return $this->_productList;
    }
    
    public function getStatus() {
        return $this->_status;
    }

    public function setId($value) {
        $this->_id = $value;
        $this->_fillProductList();
    }

    public function setUser($value) {
        $this->_user = $value;
    }

    public function setDate($value) {
        $timestamp = strtotime($value);
        $this->_date = date('Y-m-d', $timestamp);
    }

    public function setDiscount($value) {
        $this->_discount = str_replace(',', '.', $value);
        ;
    }

    public function setIsComplite($value) {
        if ($value == 'on') {
            $this->_isComplite = 1;
        } elseif (empty($value)) {
            $this->_isComplite = 0;
        } else {
            $this->_isComplite = $value;
        }
    }
    
    public function setStatus($value) {
        if ($value instanceof Status) {
            $this->_status = $value;
        } else {
            $this->_status = Status::getInstanceById($value);
        }
    }

    public function insertToDb() {
        global $__cfg;
        try {
            $sql = 'INSERT INTO `order` (user_login, date, discount, is_complite, status)
                    VALUES ("' . $this->_user . '", "' . $this->_date . '", ' . $this->_discount . ', ' . $this->_isComplite . ', ' . $this->_status->id . ')';
            $this->_db->query($sql);

            $this->_id = $this->_db->getLastInsertId();

            $this->_saveProductListToDb();
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
            return null;
        }
    }

    public function updateToDb() {
        try {
            $sql = 'UPDATE `order`
                    SET user_login="' . $this->_user . '", date="' . $this->_date . '",
                        discount=' . $this->_discount . ', is_complite="' . $this->_isComplite . '", 
                        status=' . $this->_status->id . ' 
                    WHERE id=' . $this->_id;
            $this->_db->query($sql);

            $this->_saveProductListToDb();
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
            return null;
        }
    }

    public function deleteFromDb() {
        try {
            $this->_deleteproductListFromDb();

            $sql = 'DELETE FROM `order` WHERE id=' . $this->_id;
            $this->_db->query($sql);
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
        }
    }

    private function _saveProductListToDb() {
        if (!empty($this->_productList)) {
            foreach ($this->_productList as $item) {
                $sql = 'DELETE FROM order_product WHERE order_id=' . $this->_id . ' AND product_id=' . $item['product']->id;
                $this->_db->query($sql);

                if ($item['count'] > 0) {
                    $sql = 'INSERT INTO order_product(order_id, product_id, count) VALUES(' . $this->_id . ', ' . $item['product']->id . ', ' . $item['count'] . ')';
                    $this->_db->query($sql);
                }
            }
        }
    }

    private function _deleteproductListFromDb() {
        if (!empty($this->_productList)) {
           $sql = 'DELETE FROM order_product WHERE order_id=' . $this->_id;
           $this->_db->query($sql);

           $this->_productList = array();
        }
    }

    public static function getInstanceById($id) {
        try {
            $db = simo_db::getInstance();
            $result = $db->query('SELECT * FROM `order` WHERE id=' . $id, simo_db::QUERY_MOD_ASSOC);
            if (isset($result[0])) {
                $o = new Order();
                $o->assignByHash($result[0]);
                return $o;
            }
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
            return null;
        }
    }

    public static function getInstanceByArray(array $array) {
        $o = new Order();
        $o->assignByHash($array);
        return $o;
    }

    protected function assignByHash(array $result) {
        $this->setId($result['id']);
        $this->setUser($result['user_login']);
        $this->setDate($result['date']);
        $this->setDiscount($result['discount']);
        $this->setIsComplite($result['is_complite']);
        $this->setStatus($result['status']);
    }

    protected function _fillProductList() {
        try {
            $sql = 'SELECT * FROM order_product WHERE order_id=' . $this->_id;
            $result = $this->_db->query($sql, simo_db::QUERY_MOD_ASSOC);
            if (isset($result[0])) {
                foreach ($result as $res) {
                    $this->_productList[] = array('product' => Product::getInstanceById($res['product_id']), 'count' => $res['count']);
                }
            }
        } catch (Exception $e) {
            simo_exception::registrMsg($e, $this->_debug);
        }
    }

    public function restoreFromSession() {
        if (simo_session::existVar('date', 'order')) {
            $this->_date = simo_session::getVar('date', 'order');
            $this->_user = simo_session::getVar('user', 'order');

            foreach (simo_session::getVar('productList', 'order') as $item) {
                $this->_productList[] = array('product' => Product::getInstanceById($item['product']), 'count' => $item['count']);
            }
        }
    }

    public function saveToSession() {
        if (simo_session::existVar('date', 'order')) {
            simo_session::clearVar('productList', 'order');
        } else {
            $this->_date = date('Y-m-d');
            simo_session::setVar('date', $this->_date, 'order');
            simo_session::setVar('user', $this->_user, 'order');
        }
        $temp_list = array();
        foreach ($this->_productList as $item) {
            $temp_list[] = array('product' => $item['product']->id, 'count' => $item['count']);
        }
        simo_session::setVar('productList', $temp_list, 'order');
    }

    public function clearSession() {
        simo_session::clearVars('order');
        $this->_productList = array();
    }

    public function addProduct($product, $count) {
        $key = $this->_searchProduct($product);
        if ($key !== false) {
            $this->_productList[$key]['count'] += $count;
        } else {
            $this->_productList[] = array('product' => Product::getInstanceById($product), 'count' => $count);
        }
        $this->saveToSession();
    }

    public function changeProduct($product, $count) {
        $key = $this->_searchProduct($product);
        if ($key !== false) {
            if ($count > 0) {
                $this->_productList[$key]['count'] = $count;
            } else {
                unset($this->_productList[$key]);
            }
        }
        $this->saveToSession();
    }

    private function _searchProduct($product) {
        foreach ($this->_productList as $key => $prd) {
            if ($prd['product']->id == $product) {
                return $key;
            }
        }
        return false;
    }

    public function getSumm() {
        if (!empty($this->_productList)) {
            $summ = 0;
            foreach ($this->_productList as $item) {
                $summ += $item['product']->price * $item['count'];
            }
            return $summ;
        } else
            return 0;
    }

    public function getSummWithDiscount() {
        if (!empty($this->_productList)) {
            $summ = 0;
            foreach ($this->_productList as $item) {
                $summ += $item['product']->price * $item['count'];
            }
            return $summ - $this->_discount;
        } else
            return 0;
    }

}

// end of Order
?>