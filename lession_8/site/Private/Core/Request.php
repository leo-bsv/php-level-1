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
    const Str = 0;
    const Int = 1;
    const File = 2;

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
    public static function clearVal($val) 
    {
        if (isset($val)) {
            return (string) DbDefender::escapeString(htmlspecialchars(strip_tags($val)));
        } else {
            return '';
        }
    }    
    
    // функция проверки загрузки файла
    public static function fileUploaded($filename) 
    {
        if (isset($_FILES[$filename]) && !empty($_FILES[$filename]) 
                && is_uploaded_file($_FILES[$filename]['tmp_name']))
            return true;
        else            
            return false;
    }
    
    // функция получения данных о загружаемых файлах
    public static function getFileInfo($filename)
    {
        if (self::fileUploaded($filename)) 
            return $_FILES[$filename];
    }

    // функция пакетного получения переданных значений
    public static function getValues($assocArray)
    {
        $result = [];
        foreach ($assocArray as $name => $type) {
            switch ($type) {
                case Request::Str: 
                    $result[$name] = Request::getValAsStr($name);
                    break;
                case Request::File: 
                    $result[$name] = Request::getFileInfo($name);
                    break;
                case Request::Int:
                    $result[$name] = Request::getValAsInt($name);
            }
        }
        return $result;
    }
}
