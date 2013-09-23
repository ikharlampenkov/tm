<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Julia
 * Date: 23.09.13
 * Time: 21:27
 * To change this template use File | Settings | File Templates.
 */
include_once 'C:/www/tm/library/Smarty/plugins/shared.mb_str_replace.php';
function mb_str_replace($search, $replace, $subject)
{
    if (is_array($subject)) {
        $ret = array();
        foreach ($subject as $key => $val) {
            $ret[$key] = mb_str_replace($search, $replace, $val);
        }
        return $ret;
    }

    foreach ((array)$search as $key => $s) {
        if ($s == '') {
            continue;
        }
        $r = !is_array($replace) ? $replace : (array_key_exists($key, $replace) ? $replace[$key] : '');
        $pos = mb_strpos($subject, $s, null, 'UTF-8');
        while ($pos !== false) {
            $subject = mb_substr($subject, 0, $pos, 'UTF-8') . $r . mb_substr($subject, $pos + mb_strlen($s, 'UTF-8'), null, 'UTF-8');
            $pos = mb_strpos($subject, $s, $pos + mb_strlen($r, 'UTF-8'), 'UTF-8');
        }
    }
    return $subject;
}

$str = 'ООО Кузбасская Энергосетевая Компания';
echo $str . "<br/>\r\n";

$str = preg_replace('/([^A-Za-zА-Яа-я0-9 ]*)/', '', $str);
$str = str_replace(' ', '_', $str);
echo 'test' . "<br/>\r\n";

$table = array(
    'А' => 'A',
    'Б' => 'B',
    'В' => 'V',
    'Г' => 'G',
    'Д' => 'D',
    'Е' => 'E',
    'Ё' => 'YO',
    'Ж' => 'ZH',
    'З' => 'Z',
    'И' => 'I',
    'Й' => 'J',
    'К' => 'K',
    'Л' => 'L',
    'М' => 'M',
    'Н' => 'N',
    'О' => 'O',
    'П' => 'P',
    'Р' => 'R',
    'С' => 'S',
    'Т' => 'T',
    'У' => 'U',
    'Ф' => 'F',
    'Х' => 'H',
    'Ц' => 'C',
    'Ч' => 'CH',
    'Ш' => 'SH',
    'Щ' => 'CSH',
    'Ь' => '',
    'Ы' => 'Y',
    'Ъ' => '',
    'Э' => 'E',
    'Ю' => 'YU',
    'Я' => 'YA',

    'а' => 'a',
    'б' => 'b',
    'в' => 'v',
    'г' => 'g',
    'д' => 'd',
    'е' => 'e',
    'ё' => 'yo',
    'ж' => 'zh',
    'з' => 'z',
    'и' => 'i',
    'й' => 'j',
    'к' => 'k',
    'л' => 'l',
    'м' => 'm',
    'н' => 'n',
    'о' => 'o',
    'п' => 'p',
    'р' => 'r',
    'с' => 's',
    'т' => 't',
    'у' => 'u',
    'ф' => 'f',
    'х' => 'h',
    'ц' => 'c',
    'ч' => 'ch',
    'ш' => 'sh',
    'щ' => 'csh',
    'ь' => '',
    'ы' => 'y',
    'ъ' => '',
    'э' => 'e',
    'ю' => 'yu',
    'я' => 'ya',
);

$rus = 'А Б В Г Д Е Ё Ж З И Й К Л М Н О П Р С Т У Ф Х Ц Ч Ш Щ Ь Ы Ъ Э Ю Я а б в г д е ё ж з и й к л м н о п р с т у ф х ц ч ш щ ь ы ъ э ю я';
$lat = 'A B V G D E YO ZH Z I J K L M N O P R S T U F H C CH SH CSH  Y  E YU YA a b v g d e yo zh z i j k l m n o p r s t u f h c ch sh csh  y  e yu ya';
//echo implode(' ', array_keys($table));
echo implode(' ', array_values($table));

//$output = str_replace(array_keys($table), array_values($table), $str);
//$output = mb_str_replace(array_keys($table), array_values($table), $str);
//$output = smarty_mb_str_replace(array_keys($table), array_values($table), $str);
//echo $output;

/*
$tr = array(
    "А" => "A", "Б" => "B", "В" => "V", "Г" => "G",
    "Д" => "D", "Е" => "E", "Ж" => "J", "З" => "Z", "И" => "I",
    "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
    "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
    "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH",
    "Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "YI", "Ь" => "",
    "Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b",
    "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
    "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
    "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
    "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
    "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
    "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya"
);
$rus = array_keys($tr);
$lat = array_values($tr);

// шипящие, сопящие и некоторые гласные:
//$rus = array('ё','ж','ц','ч','ш','щ','ю','я','Ё','Ж','Ц','Ч','Ш','Щ','Ю','Я');
//$lat = array('yo','zh','tc','ch','sh','sh','yu','ya','YO','ZH','TC','CH','SH','SH','YU','YA');
//$string = mb_convert_encoding(str_replace($rus, $lat , $str), "UTF-8", "UTF-8");

//echo $string;
// остальной алфавит:
//$string = strtr($string, $tr); //"АБВГДЕЗИЙКЛМНОПРСТУФХЪЫЬЭабвгдезийклмнопрстуфхъыьэ", "ABVGDEZIJKLMNOPRSTUFH_I_Eabvgdezijklmnoprstufh_i_e"
//return $string;

//echo str_replace($rus, $lat, $str);
echo mb_convert_encoding(str_replace($rus, $lat, $str), "UTF-8", "UTF-8");
//return mb_convert_encoding(strtr($str, $tr), "UTF-8", "UTF-8");  //iconv ("UTF-8", "UTF-8//TRANSLIT", strtr($str, $tr));
*/