<?php

//include_once 'DB.php';

class mysql_db_driver extends db_driver
{
 private $_connect = null;

 public function __construct() {}

 public function connect($dsn)
 {
  if (is_array($dsn)) {
  	$result = mysql_connect($dsn['host'], $dsn['user'], $dsn['password']);
  	if ($result != false) {
  	  $this->_connect = $result;
  	  return true;
  	} else {
  	  throw new StdLib_Exception('Can`t connect to host ' . $dsn['host'] . ' ' . $this->_getError());
  	  return false;
  	}
  }
 }

 public function query($sql, $mode = 1)
 {
  $result = mysql_query($sql, $this->_connect);
  if ($result) {
  	if (strpos($sql, 'SELECT') === 0) {
  	  return $this->_prepareSelectQuery($result, $mode);
  	} else {
  	  return $this->_prepareAllQuery($result);
  	}
  } else {
  	throw new StdLib_Exception('Can`t complit query: ' . $sql . ' ' . $this->_getError());
  	return false;
  }

 }

 public function setDB($db_name)
 {
  if (mysql_select_db($db_name, $this->_connect)) {
  	return true;
  } else {
  	throw new StdLib_Exception('Can`t select db ' . $db_name . $this->_getError());
  	return false;
  }
 }

 public function setCharset($charset)
 {
  try {
    $this->query('SET CHARSET ' . $charset);
  } catch (StdLib_Exception $s_e) {
  	throw new StdLib_Exception('Can`t set scharset ' . $charset);
  	return false;
  }
 }

 public function prepareString($string)
 {
  $resultstr = mysql_real_escape_string($string, $this->_connect);
  if ($resultstr !== false) {
    return $resultstr;
  } else {
  	throw new StdLib_Exception('Can`t preparestring ' . $string . ' ' . $this->_getError());
  }
 }

 public function getNextId($table, $idname)
 {
  try {
    $sql = 'SELECT (max(' . $idname . ')+1) AS nextid FROM ' . $table;
    $id = $this->query($sql, 2);
    if (isset($id[0]['nextid'])) {
      return $id[0]['nextid'];
    } else {
      return 1;
    }
  } catch (StdLib_Exception $s_e) {
  	throw new StdLib_Exception('Can`t return nextid for table ' . $table . ' and field ' . $idname);
  	return -1;
  }
 }

 public function getLastInsertId() {
  try {
    $sql = 'SELECT LAST_INSERT_ID()';
    $id = $this->query($sql);
    if (isset($id[0][0])) {
      return $id[0][0];
    } else {
      return 0;
    }
  } catch (StdLib_Exception $s_e) {
  	throw new StdLib_Exception('Can`t return last id');
  	return -1;
  }
 }

 public function __destruct()
 {
  if (is_resource($this->_connect)) {
  	mysql_close($this->_connect);
  }
 }

 private function _prepareSelectQuery($result, $mode)
 {
  if (mysql_num_rows($result) > 0) {
  	 $_row=array();
     switch ($mode) {
  		   case 1:
  		    	while ($row = mysql_fetch_row($result)) {
  		    	  $_row[]=$row;
  		    	}
  		   break;
  		   case 2:
  		    	while ($row=mysql_fetch_assoc($result)) {
  		    	  $_row[]=$row;
  		    	}
  		   break;
           case 3:
            	while ($row=mysql_fetch_object($result)) {
            	  $_row[]=$row;
            	}
  		   break;
     }
     mysql_free_result($result);
  	 return $_row;
  } else return false;
 }

 private function _prepareAllQuery($result)
 {
  if (mysql_affected_rows($this->_connect) != -1) {
  	return true;
  } else return false;
 }

 private function _getError()
 {
  if (is_resource($this->_connect)) {
  	$resultstr = 'No error: ' . mysql_errno($this->_connect) . ':: Error msg: ' . mysql_error($this->_connect) . ' ;';
  } else {
    $resultstr = 'No error: ' . mysql_errno() . ':: Error msg: ' . mysql_error() . ' ;';
  }
  return $resultstr;
 }

}

?>