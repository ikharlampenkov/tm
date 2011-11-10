<?php

class simo_smarty extends Smarty
{
	
  /**
   * Используется для оценки времени компоновки страницы
   *
   * @var int
   */
  private $_starttime = 0;
  
  public function __construct(){
    global $__cfg;
    parent::__construct();
    $this->template_dir = $__cfg['smarty.templates'];
    $this->compile_dir  = $__cfg['smarty.compile'];
    $this->cache_dir    = $__cfg['smarty.cache'];
    $this->compile_check= $__cfg['smarty.compile_check'];
    $this->debugging = $__cfg['smarty.debug'];
    $this->caching  = false;
    $this->cache_lifetime = 86400;

    $this->assign('title', $__cfg['smarty.default.title']);
    $this->assign('description', $__cfg['smarty.default.desc']);
    $this->assign('keywords', $__cfg['smarty.default.keyword']);
    
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $this->_starttime = $mtime[1] + $mtime[0];
  }

  /**
   * Вывод странички в Windows-1251
   *
   * @param string $tempfile - имя шаблона
   */
  public function display($tempfile){
    global $__cfg;
    header('Content-Type: text/html; charset=' . $__cfg['smarty.encoding']);
    header('Last-Modified: ' . date("D, d M Y H:i:s") . ' GMT');
    
    $this->assign('encoding', $__cfg['smarty.encoding']);
    $this->assign('siteurl', $__cfg['site.url']);
    
    $this->checkSmartyException();
    
    if ($__cfg['smarty.encoding'] != 'utf-8'){
      echo mb_convert_encoding($this->fetch($tempfile), 'UTF-8', 'WINDOWS-1251');
      echo "\n<!--Time exec: " . $this->getExecTime() . '-->';
    } else{
      parent::display($tempfile);
      echo "\n<!--Time exec: " . $this->getExecTime() . '-->';
    }
  }

  /**
   * Функция вычесления времени компоновки страницы
   *
   * @return float
   */
  public function getExecTime(){
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $tend = $mtime[1] + $mtime[0];
    return round(($tend - $this->_starttime), 6);
  }
  
  /**
   * Сохраняет сообщение об ошибке в сессии
   *
   * @param string $message
   * @param int $code
   */
  public static function throwSmartyException($message = '', $code = 1)
  {
   simo_session::setVar('message', $message, 'exception');
   simo_session::setVar('code', $code, 'exception');
  }
  
  /**
   * Проверяет существование сообщений об ошибке.
   * Передает сведения об ошибке в шаблон для последующего вывода
   *
   */
  private function checkSmartyException()
  {
   if (simo_session::existVar('message', 'exception')) {
   	 $this->assign('exception', '1');
   	 $this->assign('e_message', simo_session::getVar('message', 'exception'));
   	 $this->assign('e_code', simo_session::getVar('code', 'exception'));
   	 $this->catchSmartyException();
   } else {
   	 $this->assign('exception', '0');
   }
  }
  
  /**
   * Функция для отлова исключений на уровне Smarty
   *
   */
  private function catchSmartyException()
  {
   simo_session::clearVars('exception');
  }
  
}
?>