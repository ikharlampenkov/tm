<?php

class StdLib_DB {
    const QUERY_MODE_NUM = 1;
    const QUERY_MOD_ASSOC = 2;
    const QUERY_MOD_OBJECT = 3;

    /**
     * массив описывающий параметры подключнения
     *
     * @var array
     */
    private $_dsn = array();
    private $_driver = null;
    private $_conn = false;
    static private $_instance = null;
    public $debug = false;

    static function getInstance() {
        if (is_null(self::$_instance)) {
            $class = __CLASS__;
            self::$_instance = new $class();
        }
        return self::$_instance;
    }

    public function connect($dsn='') {

        if (empty($dsn)) {
            $dsn = Zend_Registry::get('production')->db->dsn;
        }

        $this->_prepareDSN($dsn);

        try {
            if (is_null($this->_driver)) {
                $this->_loadDriver();
            }

            $this->_conn = $this->_driver->connect($this->_dsn);

            if ($this->_conn) {
                $this->setDB($this->_dsn['db']);
                $this->setCharset('UTF8');
                return true;
            } else {
                return false;
            }
        } catch (StdLib_Exception $s_e) {
            throw new Exception('Can`t connect to db.' . $s_e->getMessage());
            return false;
        }
    }

    /**
     * Выполняет запрос и возвращает результат,
     * при отсутствии соединения устанавливает его
     *
     * @param string $query
     * @param integer $mode 1-циф 2-ассоц 3-объект
     * @return array
     */
    public function query($query, $mode = 1) {
        try {
            if (!$this->_conn) {
                $this->connect();
            }

            if ($this->debug) {
                StdLib_Log::logMsg($query, StdLib_Log::StdLib_Log_INFO);
                //print "<hr>".$query."<hr>\n";
            }

            $result = $this->_driver->query($query, $mode);

            return $result;
        } catch (StdLib_Exception $s_e) {
            throw new Exception('Can`t query ' . $query);
        }
    }

    public function prepareString($string) {
        try {
            if (!$this->_conn) {
                $this->connect();
            }

            if (Zend_Registry::get('production')->smarty->encoding == 'windows-1251' && (mb_detect_encoding($string) != 'UTF-8')) {
                $string = iconv('WINDOWS-1251', 'UTF-8//IGNORE', $string);
            }
            return $this->_driver->prepareString($string);
        } catch (StdLib_Exception $s_e) {
            throw new Exception('Can`t prepareString');
        }
    }

    public function prepareArray($data) {
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $data[$key] = self::prepareString($value);
            } elseif (is_array($value)) {
                $data[$key] = self::prepareArray($value);
            }
        }
        return $data;
    }

    public function prepareStringToOut($string) {
        return stripslashes($string);
    }

    public function getNextID($table, $idname = 'id') {
        try {
            if (!$this->_conn) {
                $this->connect();
            }

            return $this->_driver->getNextId($table, $idname);
        } catch (StdLib_Exception $s_e) {
            throw new Exception('Can`t get nextid ');
        }
    }

    public function getLastInsertID() {
        try {
            if (!$this->_conn) {
                $this->connect();
            }

            return $this->_driver->getLastInsertId();
        } catch (StdLib_Exception $s_e) {
            throw new Exception('Can`t get nextid ');
        }
    }

    public function setCharset($charset) {
        try {
            if (!$this->_conn) {
                $this->connect();
            }

            $this->_driver->setCharset($charset);
        } catch (StdLib_Exception $s_e) {
            throw new Exception($s_e->getMessage());
        }
    }

    public function setDB($dbname) {
        try {
            if (!$this->_conn) {
                $this->connect();
            }

            $this->_driver->setDB($dbname);
        } catch (StdLib_Exception $s_e) {
            throw new Exception('Can`t set db.' . $s_e->getMessage());
        }
    }

    private function __construct() {

    }

    private function _prepareDSN($dsn) {
        $result = parse_url($dsn);
        $this->_dsn['scheme'] = $result['scheme'];
        $this->_dsn['host'] = $result['host'];
        $this->_dsn['user'] = $result['user'];
        $this->_dsn['password'] = $result['pass'];
        $this->_dsn['db'] = str_replace('/', '', $result['path']);
        
        if (!empty($result['port'])) {
            $this->_dsn['host'] .= ':' . $result['port'];
        }
    }

    private function _loadDriver() {

        $module_name = $this->_dsn['scheme'] . '_db_driver';

        $result = file_exists(Zend_Registry::get('production')->db->driver->path . '/' . $module_name . '.php');

        if ($result) {
            include_once Zend_Registry::get('production')->db->driver->path . '/' . $module_name . '.php';
            $this->_driver = new $module_name;
            return true;
        } else {
            $o_log = new StdLib_Log();
            $o_log->setLogLevel(2);
            throw new StdLib_Exception('Can`t load driver ' . $this->_dsn['scheme'] . Zend_Registry::get('production')->db->driver->path . $module_name . '.php');
            return false;
        }
    }

}

?>