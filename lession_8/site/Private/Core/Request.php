<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс облегчающий работу с запросами
 *
 */

class Request
{
    // функция проверки передачи параметра через запрос
    public static function valueExists($val) {
        return isset($_REQUEST[$val]);
    }
    
    // функция получения числовых данных из запроса
    public static function getValAsInt($val) {
        if (isset($_REQUEST[$val]) && is_numeric($_REQUEST[$val])) {
            return (int)$_REQUEST[$val];
        } else {
            return 0;
        }
    }   

    // функция получения строковых данных из запроса
    public static function getValAsStr($val) {
        if (isset($_REQUEST[$val])) {
            return (string) DbDefender::escapeString(htmlspecialchars(strip_tags($_REQUEST[$val])));
        } else {
            return '';
        }
    }      

    // функция очистки строки
    public static function clearVal($val) {
        if (isset($val)) {
            return (string) DbDefender::escapeString(htmlspecialchars(strip_tags($val)));
        } else {
            return '';
        }
    }      
}
