<?php

/**
*
* Автор: Бурков Сергей aka Leo.
*
* Домашнее задание к уроку № 3.
*
*/

// правильный перенос строки в зависимости от режима 
// запуска (консольный или веб)
$eol = '';
switch (PHP_SAPI) {
    case 'cli': 
        $eol = PHP_EOL;
        break;
    default:     
        $eol = '<br>';
}

// Ответ на вопрос ДЗ № 1.
echo "Вывод ответа на вопрос ДЗ №1: $eol";
echo "Числа в диапазоне [0..100] которые делятся на 3 без остатка $eol";
$i = 0;
while ($i <= 100) {
    if ($i % 3 == 0) echo $i . $eol;
    $i++;
}
echo $eol;


// Ответ на вопрос ДЗ № 2.
echo "Вывод ответа на вопрос ДЗ №2:$eol";
$i = 0;
do {   
    echo "$i - ";
    
    // оптимальный вариант кода
    if ($i == 0) echo "это ноль.";
    else echo ($i % 2 ? "" : "не") . "четное число.";
    
    // плохо читаемый, но красивый вариант :)   
    //echo $i ?                                    // условие - значение $i != 0 ?
    //    ($i % 2 ? "" : "не") . "четное число." : // да, $i чётное? 
    //    "это ноль.";                             // нет
           
    echo $eol;
    $i++;    
} while ($i <= 10);

echo $eol;


// Ответ на вопрос ДЗ № 3.
$kladr = [ 'Московская область' => ['Москва', 
                                    'Зеленоград', 
                                    'Клин'],
           'Ленинградская область' => ['Санкт-Петербург', 
                                       'Всеволожск', 
                                       'Павловск', 
                                       'Кронштадт'],
           'Рязанская область' => ['Рязань', 
                                   'Шацк', 
                                   'Скопин', 
                                   'Михайлов'] ];

echo "Вывод ответа на вопрос ДЗ №3:$eol";

foreach ($kladr as $region => $cities) {
    echo "$region: $eol";
    echo implode(', ', $cities) . $eol;
}

echo $eol;


// Ответ на вопрос ДЗ № 4.
$dictionary = [
    'а' => 'a','б' => 'b','в' => 'v','г' => 'g','д' => 'd','е' => 'e',
    'ё' => 'io','ж' => 'zh','з' => 'z','и' => 'i','й' => 'y','к' => 'k',
    'л' => 'l','м' => 'm','н' => 'n','о' => 'o','п' => 'p','р' => 'r',
    'с' => 's','т' => 't','у' => 'u','ф' => 'f','х' => 'h','ц' => 'ts',
    'ч' => 'ch','ш' => 'sh','щ' => 'sht','ъ' => 'a','ы' => 'i','ь' => 'y',
    'э' => 'e','ю' => 'yu','я' => 'ya','А' => 'A','Б' => 'B','В' => 'V',
    'Г' => 'G','Д' => 'D','Е' => 'E','Ё' => 'Io','Ж' => 'Zh','З' => 'Z',
    'И' => 'I','Й' => 'Y','К' => 'K','Л' => 'L','М' => 'M','Н' => 'N',
    'О' => 'O','П' => 'P','Р' => 'R','С' => 'C','Т' => 'T','У' => 'U',
    'Ф' => 'F','Х' => 'H','Ц' => 'Ts','Ч' => 'Ch','Ш' => 'Sh','Щ' => 'Sht',
    'Ъ' => 'A','Ы' => 'I','Ь' => 'Y','Э' => 'E','Ю' => 'Yu','Я' => 'Ya'
];

function translate($text, $dictionary) {    
    foreach ($dictionary as $cyr => $other) {
        $text = str_replace($cyr, $other, $text);
    }
    return $text;
}

echo "Вывод ответа на вопрос ДЗ №4:$eol";

$cyr_text = 'Это пример работы функции транслитерации';
$trans_text = translate($cyr_text, $dictionary);

echo "Исходный текст:$eol";
echo $cyr_text . $eol;
echo "Результирующий текст:$eol";
echo $trans_text . $eol . $eol;


// Ответ на вопрос ДЗ № 5.
function putUnderscore($text) {
    return str_replace(" ", "_", $text);;
}

$text_with_ws = "Это пример работы функции замены пробела";

echo "Вывод ответа на вопрос ДЗ №5:$eol";
echo "Исходный текст:$eol";
echo $text_with_ws . $eol;
echo "Результирующий текст:$eol";
echo putUnderscore($text_with_ws) . $eol . $eol;


// Ответ на вопрос ДЗ № 7*.
echo "Вывод ответа на вопрос ДЗ №7*:$eol";
for ($i=0; $i<10; print $i++ . $eol){}
echo $eol;


// Ответ на вопрос ДЗ №8*.
echo "Вывод ответа на вопрос ДЗ №8*:$eol";

foreach ($kladr as $region => $cities) {
    echo "$region: $eol";
    $cities = array_filter($cities, 
                            function($v, $k) {
                                if (mb_substr($v, 0, 1) == "К") return true;
                            }, 
                            ARRAY_FILTER_USE_BOTH);
    echo implode(', ', $cities) . $eol;
}

echo $eol;


// Ответ на вопрос ДЗ №9*.

$url = "Антон Павлович Чехов/Человек в футляре";

$processed_url = putUnderscore(translate($url, $dictionary));

echo "Вывод ответа на вопрос ДЗ №9*:$eol";
echo "Исходный текст:$eol";
echo $url . $eol;
echo "Результирующий текст:$eol";
echo $processed_url . $eol . $eol;