<?php

class StdLib_Functions
{

    static public function toLowerCase($str)
    {
        $small = array("а", "б", "в", "г", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "э", "ю", "я", "ъ", "ь", "ы", "ї", "?");
        $large = array("А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Э", "Ю", "Я", "Ъ", "Ь", "Ы", "Ї", "?");
        return str_replace($large, $small, $str);
    }

    static public function toUpperCase($str)
    {
        $small = array("а", "б", "в", "г", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "э", "ю", "я", "ъ", "ь", "ы", "ї", "?");
        $large = array("А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Э", "Ю", "Я", "Ъ", "Ь", "Ы", "Ї", "?");
        return str_replace($small, $large, $str);
    }

    static public function translitIt($str)
    {
        $str = mb_ereg_replace('/([^A-Za-zА-Яа-я0-9 ]*)/', '', $str);
        $str = str_replace(' ', '_', $str);

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
        //$rus = array_keys($tr);
        //$lat = array_values($tr);

        return strtr($str, $tr);
        //return mb_convert_encoding(str_replace($rus, $lat, $str), "UTF-8", "UTF-8");
    }

    static public function getFileExt($fname)
    {
        $ext = explode('.', strtolower($fname));
        if (count($ext == 2)) return $ext[1];
        return false;
    }

    static public function _delFile($fname)
    {
        global $__cfg;
        if (file_exists($fname) && is_file($fname)) {
            StdLib_Log::logMsg('Удален файл: ' . $fname, StdLib_Log::StdLib_Log_INFO);
            unlink($fname);
            return true;
        } else {
            throw new Exception('Не возможно удалить файл');
        }
    }

    static public function generateUniq($number = 8, $type = 'str')
    {
        $num = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
        $arr = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l',
            'm', 'n', 'p', 'r', 's', 't', 'u', 'v', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L',
            'M', 'N', 'P', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z',
            '1', '2', '3', '4', '5', '6', '7', '8', '9');
        if ($type == 'num') $arr = $num;
        $pass = "";
        for ($i = 0; $i < $number; $i++) {
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
        return '%' . $word;
    }

    static public function chLocation($page)
    {
        global $__cfg;
        header("Location: " . $__cfg['site.url'] . $page);
    }


}

?>