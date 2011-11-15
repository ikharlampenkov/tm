<?php

class simo_db {
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
        global $__cfg;

        if (empty($dsn)) {
            $dsn = $__cfg['db.dsn'];
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
        } catch (simo_exception $s_e) {
            throw new Exception('Can`t connect to db');
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
                simo_log::logMsg($query, simo_log::SIMO_LOG_INFO);
                //print "<hr>".$query."<hr>\n";
            }

            $result = $this->_driver->query($query, $mode);

            return $result;
        } catch (simo_exception $s_e) {
            throw new Exception('Can`t query ' . $query);
        }
    }

    public function prepareString($string) {
        global $__cfg;
        try {
            if (!$this->_conn) {
                $this->connect();
            }

            if ($__cfg['smarty.encoding'] == 'windows-1251' && (mb_detect_encoding($string) != 'UTF-8')) {
                $string = iconv('WINDOWS-1251', 'UTF-8//IGNORE', $string);
            }
            return $this->_driver->prepareString($string);
        } catch (simo_exception $s_e) {
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
        } catch (simo_exception $s_e) {
            throw new Exception('Can`t get nextid ');
        }
    }

    public function getLastInsertID() {
        try {
            if (!$this->_conn) {
                $this->connect();
            }

            return $this->_driver->getLastInsertId();
        } catch (simo_exception $s_e) {
            throw new Exception('Can`t get nextid ');
        }
    }

    public function setCharset($charset) {
        try {
            if (!$this->_conn) {
                $this->connect();
            }

            $this->_driver->setCharset($charset);
        } catch (simo_exception $s_e) {
            throw new Exception($s_e->getMessage());
        }
    }

    public function setDB($dbname) {
        try {
            if (!$this->_conn) {
                $this->connect();
            }

            $this->_driver->setDB($dbname);
        } catch (simo_exception $s_e) {
            throw new Exception('Can`t set db');
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
        global $__cfg;

        $module_name = $this->_dsn['scheme'] . '_db_driver';
        $result = file_exists($__cfg['db.driver.path'] . $module_name . '.php');

        if ($result) {
            include_once $__cfg['db.driver.path'] . $module_name . '.php';
            $this->_driver = new $module_name;
            return true;
        } else {
            $o_log = new simo_log();
            $o_log->setLogLevel(2);
            throw new simo_exception('Can`t load driver ' . $this->_dsn['scheme']);
            return false;
        }
    }

}

?>