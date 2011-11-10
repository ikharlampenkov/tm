<?php

/**
 * Класс исключений simo
 * 
 *
 */
class simo_exception extends Exception {
  
  public function __construct($msg = '', $code = 0)
  {
   parent::__construct($msg, $code);
   simo_log::logMsg($msg, simo_log::SIMO_LOG_ERROR);
  }
  
  static public function getMsg(&$e)
  {
   $resultstr = 'Message: ' . $e->getMessage() . ' :: File: ' . $e->getFile() . ' :: Line:' . $e->getLine() . ' ;';
   return $resultstr;
  }

  static public function registrMsg(&$e, $debug)
  {
   if ($debug) {
     simo_smarty::throwSmartyException(simo_exception::getMsg($e));
   }
  }
}
?>