<?php

class simo_functions
{

  static public function toLowerCase($str){
    $small=array("а","б","в","г","д","е","ё","ж","з","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","э","ю","я","ъ","ь","ы","ї","?");
    $large=array("А","Б","В","Г","Д","Е","Ё","Ж","З","И","Й","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Э","Ю","Я","Ъ","Ь","Ы","Ї","?");
    return str_replace($large, $small, $str);
  }

  static public function toUpperCase($str){
    $small=array("а","б","в","г","д","е","ё","ж","з","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","э","ю","я","ъ","ь","ы","ї","?");
    $large=array("А","Б","В","Г","Д","Е","Ё","Ж","З","И","Й","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Э","Ю","Я","Ъ","Ь","Ы","Ї","?");
    return str_replace($small, $large, $str);
  }

  static public function getFileExt($fname) {
    $ext = explode('.', strtolower($fname));
    if (count($ext == 2)) return $ext[1];
    return false;
  }

  static public function _delFile($fname){
    global $__cfg;
    if (file_exists($fname) && is_file($fname)) {
      StdLib_Log::logMsg('Удален файл: ' . $fname, StdLib_Log::StdLib_Log_INFO);
      unlink($fname);
      return true;
    } else {
        throw new Exception('Не возможно удалить файл');
    }
  }

  static public function generateUniq($number = 8, $type = 'str'){
    $num = array('1','2','3','4','5','6','7','8','9', '0');
    $arr = array('a','b','c','d','e','f','g','h','i','j','k','l',
                 'm','n','p','r','s','t','u','v','x','y','z',
                 'A','B','C','D','E','F','G','H','I','J','K','L',
                 'M','N','P','R','S','T','U','V','X','Y','Z',
                 '1','2','3','4','5','6','7','8','9');
    if ($type == 'num' ) $arr = $num;
    $pass = "";
    for($i = 0; $i < $number; $i++) {
      $index = rand(0, count($arr) - 1);
      $pass .= $arr[$index];
    }
    return $pass;
  }
  
  static public function changeWord($word)
  {
   global $__cfg;
   if ($__cfg['smarty.encoding'] != 'utf-8') {
  	 $word = iconv('UTF-8', 'WINDOWS-1251//IGNORE', $word);
   }
   $word = bin2hex($word);
   $result = array();
   $result = str_split($word, 2);
   $word = implode('%', $result);
   return '%'.$word;
  }

  static public function chLocation($page)
  {
   global $__cfg;
   header("Location: " . $__cfg['site.url'] . $page);
  }
}

?>