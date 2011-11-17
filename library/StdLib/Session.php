<?php

/**
 * Класс для работы с сессиями
 *
 */
class StdLib_Session {
  
  const APP_PREF = 'simo';
   
  /**
   * Установить сессионную переменную
   *
   * @param string $name - имя переменной
   * @param string $value - значение
   * @param string $prefix - префикс, идентифицирует тип переменной
   * @return bool
   */
  static public function setVar($name, $value, $prefix = StdLib_Session::APP_PREF)
  {
    if (!empty($name) && isset($value) ) {
      $_SESSION[$prefix][$name] = $value;
      return true;
    }
    return false;
  }
  
  /**
   * Возвращает значение сессионной переменной по ее имени
   *
   * @param string $name - имя переменной
   * @param string $prefix - префикс, идентифицирует тип переменной
   * @return string
   */
  static public function getVar($name, $prefix = StdLib_Session::APP_PREF)
  {
    if (!empty($name) && isset($_SESSION[$prefix][$name])) {
        return $_SESSION[$prefix][$name];
    }
    return null;
  }
  
  /**
   * Проверка на существование сессионной переменной
   *
   * @param string $name - имя переменной
   * @param string $prefix - префикс, идентифицирует тип переменной
   * @return bool
   */
  static public function existVar($name, $prefix = StdLib_Session::APP_PREF)
  {
    if (isset($_SESSION[$prefix][$name])) {
      return true;
    }
    return false;
  }
  
  /**
   * Удаляет все сессионные переменные
   *
   * @param string $prefix - префикс, идентифицирует тип переменной
   */
  static public function clearVars($prefix = StdLib_Session::APP_PREF)
  {
    unset($_SESSION[$prefix]);
  }
  
  /**
   * Удаляет сессионную переменную
   *
   * @param string $name - имя переменной
   * @param string $prefix[option] - префикс, идентифицирует тип переменной
   */
  static public function clearVar($name, $prefix = StdLib_Session::APP_PREF)
  {
    unset($_SESSION[$prefix][$name]);
  }
  
  /**
   * Очищает значение сессионной переменной
   *
   * @param string $name - имя переменной
   * @param string $prefix - префикс, идентифицирует тип переменной
   */
  static public function delVar($name, $prefix = StdLib_Session::APP_PREF)
  {
      $_SESSION[$prefix][$name] = '';
  }
  
}

?>