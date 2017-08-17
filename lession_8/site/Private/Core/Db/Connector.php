<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс поднимающий подключение к БД
 *
 */

class DbConnector implements InterfaceDb
{

    public function __construct()
    {
        $link = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD);    
        if (isset($link)) {
            if ($this->prepareDB($link)) {
                mysqli_set_charset($link, self::MYSQL_CHARSET);
                App::$db = $link;
            } else {
                App::Msg('Ошибка при попытке подключения к базе данных.');
            }
        } else {
            App::Msg('Ошибка при попытке подключения к серверу баз данных.');
        }
    }
    
    // проверяем существует ли БД и необходимые таблицы
    private function prepareDB(&$link) {          
        
        // запрашиваем таблицы
        $sql = 'show databases;';
        $result = mysqli_query($link, $sql);
        $db_exists = false;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['Database'] == self::DB_NAME) {
                $db_exists = true; // база существует
                break;
            }
        }

        // если базы не существует
        if (!$db_exists) {
            $sql = 'create database if not exists ' . self::DB_NAME . 
                   ' character set utf8 collate utf8_general_ci;';
            if (!mysqli_query($link, $sql)) {
                return false; // не удалось создать базу данных
            }        
        } 

        // если база существует или была только что создана
        $sql = 'use ' . self::DB_NAME . ';';
        if (!mysqli_query($link, $sql)) {
            return false; // не удалось активировать базу данных
        }         

        // наши таблицы
        $tables = [

            ['name' => 'goods',
             'exists' => false,
             'sql' => 'create table if not exists `goods` ('
                        . '`id` int auto_increment primary key, '
                        . '`filename` tinytext not null,'
                        . '`name` tinytext not null,'
                        . '`short_descr` text,'
                        . '`feature` text,'
                        . '`long_descr` text,'
                        . '`price` decimal(10, 2));'],        

            ['name' => 'goods_recalls',
             'exists' => false,
             'sql' => 'create table if not exists `goods_recalls` ('
                        . '`id` int auto_increment primary key, '
                        . '`goods_id` int not null, '
                        . '`author` tinytext not null, '
                        . '`recall` text not null);'],

            ['name' => 'users',
             'exists' => false,
             'sql' => 'create table if not exists `users` ('
                        . '`id` int auto_increment primary key, '
                        . '`login` tinytext not null, '
                        . '`pass` tinytext not null, '
                        . '`email` tinytext not null, '
                        . '`role` int not null);'],

            ['name' => 'orders',
             'exists' => false,
             'sql' => 'create table if not exists `orders` ('
                        . '`id` int auto_increment primary key, '
                        . '`timestamp` int not null, '
                        . '`buyers_id` tinytext not null);'],

            ['name' => 'sold_goods',
             'exists' => false,
             'sql' => 'create table if not exists `sold_goods` ('
                        . '`id` int auto_increment primary key, '
                        . '`orders_id` int not null, '
                        . '`price` decimal(10,2) not null, '
                        . '`quantity` int not null);'],

            ['name' => 'images',
             'exists' => false,
             'sql' => 'create table if not exists `images` ('
                        . '`id` int auto_increment primary key, '
                        . '`filename` tinytext not null,'
                        . '`path` text not null, '
                        . '`size` int not null, '
                        . '`views` int);'],        

            ['name' => 'comments',
             'exists' => false,
             'sql' => 'create table if not exists `comments` ('
                        . '`id` int auto_increment primary key, '
                        . '`images_id` int not null, '
                        . '`author` tinytext not null, '
                        . '`comment` text not null);']

            ];

        $sql = 'show tables;';
        $result = mysqli_query($link, $sql);
        $tables_exists = array_column($tables, 'exists', 'name');
        while ($row = mysqli_fetch_assoc($result)) {
            $table_name = $row['Tables_in_galary'];
            if (array_key_exists($table_name, $tables_exists)) {
                $table_exists[$table_name] = true;
            }
        }

        // если таблицы не существует - создадим её
        $tables_sql = array_column($tables, 'sql', 'name');
        foreach ($tables_exists as $table => $exists) {        
            if (!$exists) {            
                if (!mysqli_query($link, $tables_sql[$table])) {
                    return false; // не удалось создать таблицу
                }
            } 
        }    
        unset ($tables);
        unset ($tables_exists);
        unset ($tables_sql);

        return true;
    }        
}
