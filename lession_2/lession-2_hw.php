<?php

/**
*
* Автор: Бурков Сергей aka Leo.
*
* Домашнее задание к уроку № 2.
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
$a = 3;
$b = 8;

echo "Вывод ответа на вопрос ДЗ №1: $eol";
echo "a = $a $eol";
echo "b = $b $eol";
if ($a > 0 && $b > 0) echo ($a - $b) . $eol;
if ($a < 0 && $b < 0) echo ($a * $b) . $eol;
if ($a > 0 && $b < 0) echo ($a + $b) . $eol;

echo $eol;

// Ответ на вопрос ДЗ № 2.
$a = rand(0, 15);

echo "Вывод ответа на ДЗ №2: $eol";
echo "a = $a $eol";
echo "Выводим числа от a до 15 $eol";
switch ($a) {
    case 0: echo 0 . $eol;
    case 1: echo 1 . $eol;
    case 2: echo 2 . $eol;
    case 3: echo 3 . $eol;
    case 4: echo 4 . $eol;
    case 5: echo 5 . $eol;
    case 6: echo 6 . $eol;
    case 7: echo 7 . $eol;
    case 8: echo 8 . $eol;
    case 9: echo 9 . $eol;
    case 10: echo 10 . $eol;
    case 11: echo 11 . $eol;
    case 12: echo 12 . $eol;
    case 13: echo 13 . $eol;
    case 14: echo 14 . $eol;
    case 15: echo 15 . $eol;
}

echo $eol;

// Ответ на вопрос ДЗ № 3.

function addition($a, $b) {
    return $a + $b;
}

function subtraction($a, $b) {
    return $a - $b;
}

function multiplication($a, $b) {
    return $a * $b;
}

function division($a, $b) {
    return $a / $b;
}

// Ответ на вопрос ДЗ № 4.

function mathOperation($a, $b, $operation) {
    switch ($operation) {
        case 'addition':
            return addition($a, $b);
            break;
        case 'subtraction':    
            return subtraction($a, $b);
            break;
        case 'multiplication':    
            return multiplication($a, $b);
            break;
        case 'divition':    
            return division($a, $b);
    }
}

// Альтернативный ответ на вопрос ДЗ № 4.
function mathOperationAlt($a, $b, $operation) {
    if (function_exists($operation)) 
        echo call_user_func_array ($operation, [$a, $b]) . $eol; 
}


// Ответ на вопрос ДЗ № 5.

// использовать функцию date(), сдавал в прошлом ДЗ.
$year = date("Y");
/* дальше вставить её в код хтмл вот так:
 * <?= $year ?>
 * или так
 * <?php echo $year; ?>
 * или даже так
 * <% $year %> // ASP-теги, если подключены
 */
echo "Вывод ответа на ДЗ №5: $eol";
echo "Текущий год: $year $eol $eol";


// Ответ на вопрос ДЗ № 6.
function power($val, $pow) {
    static $pow_iteration = 0;
    static $result = 1;    
    if ($pow_iteration < $pow) {        
        $result *= $val;
        $pow_iteration++;
        return power($val, $pow);
    }
    else return $result;
}

$val = 10;
$pow = 3;
$result = power($val, $pow);

echo "Вывод ответа на ДЗ №6*: $eol";
echo "$val в степени $pow = $result $eol";
echo $eol;


// Ответ на вопрос ДЗ № 7.
$hours = date("G");
$minutes = date("i");

function in_range($val, $min, $max) {
    return ($val >= $min && $val <= $max);
}

function get_label($value, $labels) {
    if ($value <> 11 && fmod($value, 10) == 1) 
        return $labels[0];
    else if (in_range($value, 2, 4) || 
            $value > 20 && in_range( fmod($value, 10) , 2, 4)) 
        return $labels[1];
    else 
        return $labels[2];
}

echo "Вывод ответа на ДЗ №7*: $eol";
$hours_labels = ["час", "часа", "часов"];
$minutes_labels = ["минута", "минуты", "минут"];

echo  $hours . " " . get_label($hours, $hours_labels) . " " . 
      $minutes  . " " . get_label($minutes, $minutes_labels) . $eol . $eol;