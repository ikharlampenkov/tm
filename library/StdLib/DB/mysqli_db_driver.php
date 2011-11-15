<?php

class mysqli_db_driver extends StdLib_DB_Driver {

    private $_connect = null;

    public function __construct() {

    }

    public function connect($dsn) {
        if (is_array($dsn)) {
            $result = new mysqli($dsn['host'], $dsn['user'], $dsn['password']);
            if ($result != false) {
                $this->_connect = $result;
                return true;
            } else {
                throw new StdLib_Exception('Can`t connect to host ' . $dsn['host'] . ' ' . $this->_getError());
                return false;
            }
        }
    }

    public function query($sql, $mode = 1) {
        $result = $this->_connect->query($sql);
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

    public function setDB($db_name) {
        if ($this->_connect->select_db($db_name)) {
            return true;
        } else {
            throw new StdLib_Exception('Can`t select db ' . $db_name . $this->_getError());
            return false;
        }
    }

    public function setCharset($charset) {
        try {
            $this->query('SET CHARSET ' . $charset);
        } catch (StdLib_Exception $s_e) {
            throw new StdLib_Exception('Can`t set scharset ' . $charset);
            return false;
        }
    }

    public function prepareString($string) {
        $resultstr = $this->_connect->real_escape_string($string);
        if ($resultstr !== false) {
            return $resultstr;
        } else {
            throw new StdLib_Exception('Can`t preparestring ' . $string . ' ' . $this->_getError());
        }
    }

    public function getNextId($table, $idname) {
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

    public function __destruct() {
        if (is_object($this->_connect)) {
            $this->_connect->close();
        }
    }

    private function _prepareSelectQuery($result, $mode) {
        if ($result->num_rows > 0) {
            $_row = array();
            switch ($mode) {
                case 1:
                    while ($row = $result->fetch_row()) {
                        $_row[] = $row;
                    }
                    break;
                case 2:
                    while ($row = $result->fetch_assoc()) {
                        $_row[] = $row;
                    }
                    break;
                case 3:
                    while ($row = $result->fetch_object()) {
                        $_row[] = $row;
                    }
                    break;
            }
            return $_row;
        } else
            return false;
    }

    private function _prepareAllQuery($result) {
        if ($this->_connect->affected_rows != -1) {
            return true;
        } else
            return false;
    }

    private function _getError() {
        if (is_object($this->_connect)) {
            $resultstr = 'No error: ' . $this->_connect->errno . ':: Error msg: ' . $this->_connect->error . ' ;';
        } else {
            $resultstr = 'No error: ' . mysqli_connect_errno() . ':: Error msg: ' . mysqli_connect_error() . ' ;';
        }
        return $resultstr;
    }

}

?>