<?php

/**
 * Класс исключений simo
 * 
 *
 */
class StdLib_Exception extends Exception {
  
  public function __construct($msg = '', $code = 0)
  {
   parent::__construct($msg, $code);
   StdLib_Log::logMsg($msg, StdLib_Log::StdLib_Log_ERROR);
  }
  
  static public function getMsg(&$e)
  {
   $resultstr = 'Message: ' . $e->getMessage() . ' :: File: ' . $e->getFile() . ' :: Line:' . $e->getLine() . ' ;';
   return $resultstr;
  }

  static public function registrMsg(&$e, $debug)
  {
   if ($debug) {
     simo_smarty::throwSmartyException(StdLib_Exception::getMsg($e));
   }
  }
}
?>