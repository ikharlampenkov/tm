<?php
/*

  CREATE TABLE `simo`.`tblsyslog` (
  `log_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `log_type` VARCHAR( 10 ) NOT NULL DEFAULT ' ',
  `message` VARCHAR( 255 ) NOT NULL DEFAULT ' ',
  `log_date` DATETIME NOT NULL 
  ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci 

*/

/**
 * Класс, содержит набор функций
 * обеспечивающих логирование
 *
 */

class StdLib_Log
{
    /**
     * Константа, используется при логировании,
     * тип сообщения alert
     *
     */
    const StdLib_Log_ALERT = 'alert';
    /**
     * Константа, используется при логировании,
     * тип сообщения info
     *
     */
    const StdLib_Log_INFO = 'info';
    /**
     * Константа, используется при логировании,
     * тип сообщения error
     *
     */
    const StdLib_Log_ERROR = 'error';

    /**
     * Определяет уровень логирования
     *
     * @var int
     */
    static private $_log_level = 0;

    /**
     * Список возможных уровней логирования
     * 0 - нет логов
     * 1 - логи только в БД
     * 2 - логи только в файл
     * 3 = 1 + 2
     *
     * @var array
     */
    private $_level_array = array('0', '1', '2', '3');

    /**
     * Имя файла для логов
     *
     * @var string
     */
    static private $_log_file = 'syslog.txt';

    /**
     * Ссылка на класс для работы с БД
     *
     * @var StdLib_DB
     */
    private $_db;

    /**
     * Название таблицы для логирования
     *
     * @var string
     */
    static private $_table = 'tblsyslog';

    public function __construct()
    {
        $this->_db = StdLib_DB::getInstance();
    }

    /**
     * Интерфейсная функция для записи логов, вызывает нужные функции в зависимости от уровня логирования
     *
     * @param string $message - сообщение
     * @param string $type - тип сообщения
     */
    static public function logMsg($message, $type = StdLib_Log::StdLib_Log_INFO)
    {
        switch (self::$_log_level) {
            case 1:
                self::_logToDB($message, $type);
                break;
            case 2:
                self::_logToFile($message, $type);
                break;
            case 3:
                self::_logToFile($message, $type);
                self::_logToDB($message, $type);
                break;
        }
    }

    public function getAllLog()
    {
        $sql = 'SELECT * FROM ' . $this->_table . ' ORDER BY log_type, DESC log_date';
        $result = $this->_db->query($sql, 2);
        if (isset($result) && !empty($result)) {
            return $result;
        }
    }

    public function delLog($id)
    {
        $this->_db->query('DELETE FROM ' . $this->_table . ' WHERE log_id=' . (int)$id);
    }

    public function delAllLog()
    {
        $this->_db->query('TRUNCATE ' . $this->_table);
    }

    public function setLogLevel($level)
    {
        if (in_array($level, $this->_level_array)) {
            self::$_log_level = $level;
        } else {
            self::$_log_level = '0';
        }
    }


    /**
     * Запись сообщения лога в БД
     *
     * @param string $message - сообщение
     * @param string $type - тип сообщения
     */
    private function _logToDB($message, $type)
    {
        $db = StdLib_DB::getInstance();
        $sql = 'INSERT INTO ' . self::$_table . '(log_type, message, log_date) VALUES ("' . $type . '", "' . addslashes($message) . '", NOW())';
        if ($db->debug == false) {
            $db->query($sql);
        } else {
            $db->debug = false;
            $db->query($sql);
            $db->debug = true;
        }

    }

    private function _logToFile($message, $type)
    {
        $errorString = $type . '   ' . $message . '  ' . date('d.m.Y H:i') . "\r\n";
        error_log($errorString, 3, Zend_Registry::get('production')->log->path . '/' . self::$_log_file);
    }

}

?>