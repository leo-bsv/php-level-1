<?php
/**
 * Вспомогательные функции
 */

// функция получения числовых данных из POST-запроса
function getReqAsInt($val) {
    if (isset($_REQUEST[$val]) && is_numeric($_REQUEST[$val])) {
        return (int)$_REQUEST[$val];
    } else {
        return 0;
    }
}   

// функция получения строковых данных из POST-запроса
function getReqAsStr($val) {
    if (isset($_REQUEST[$val])) {
        return (string) htmlspecialchars(strip_tags($_REQUEST[$val]));
    } else {
        return '';
    }
}   

// функция проверки передачи параметра через POST-запрос
function inRequest($val) {
    return isset($_REQUEST[$val]);
}