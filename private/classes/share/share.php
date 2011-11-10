<?php

abstract class share
{
 protected $_db = null;
 
 protected $_debug = false;
 
 public function __construct()
 {
  global $__cfg;
  
  $this->_db = simo_db::getInstance();
  $this->_db->debug = $__cfg['db.driver.debug'];
  $this->_debug = $__cfg['system.debug'];
 }
 
 public function __destruct()
 {
  unset($this->_debug);
  unset($this->_db);
 }
 
}

/*
  try{

  } catch (Exception $e) {
  	simo_exception::registrMsg($e, $this->_debug);
  }
*/
?>