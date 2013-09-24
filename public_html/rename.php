<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Moris
 * Date: 24.09.13
 * Time: 23:18
 * To change this template use File | Settings | File Templates.
 */

function translitIt($str)
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

$dir = realpath(dirname(__FILE__)) . '/files/';
echo $dir;

$pdo = new PDO('mysql:dbname=cl71252_tm;host=localhost', 'cl71252_tm', 'e10adc39h');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$selectStatement = $pdo->prepare('SELECT * FROM tm_document WHERE is_folder=1 ORDER BY id');
$updateStatement = $pdo->prepare('UPDATE tm_document SET file=:file WHERE id=:id');

try {
    $selectStatement->execute();
    $folderList = $selectStatement->fetchAll();

    foreach ($folderList as $folder) {
        if ($folder['file'] != '' && file_exists($dir . $folder['file'])) {
            echo $folder['file'];
            $newFile = translitIt($folder['title']);
            $result = rename($dir . $folder['file'], $dir . $newFile);

            if ($result == true) {
                try {
                    $updateStatement->execute(array('file' => $newFile, 'id' => $folder['id']));
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            } else {
                echo 'bad ' . $folder['title'] . "\r\n";
            }
        }

    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}