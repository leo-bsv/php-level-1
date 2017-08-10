<?php
/**
 * Структура БД
 * Движок - InnoDB
 * Название - galary
 * Кодировка - utf8
 * 
 * Таблица
 * Название - images
 * Поля:
 *      id - int - AI - primary key
 *      filename - tinytext - not null
 *      path - text - not null
 *      size - int - not null
 *      views - int - null
 */

// проверяем существует ли БД и необходимые таблицы
function prepareDB(&$link) {
    // запрашиваем таблицы
    $sql = 'show databases;';
    $result = mysqli_query($link, $sql);
    $db_exists = false;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['Database'] == DB_NAME) {
            $db_exists = true; // база существует
            break;
        }
    }
    
    // если базы не существует
    if (!$db_exists) {
        $sql = 'create database if not exists ' . DB_NAME . 
               ' character set utf8 collate utf8_general_ci;';
        if (!mysqli_query($link, $sql)) {
            return false; // не удалось создать базу данных
        }        
    } 
    
    // если база существует или была только что создана
    $sql = 'use ' . DB_NAME . ';';
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

// подключение к базе данных
function connectToDB(&$error){
    $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);    
    if (isset($link)) {
        if (prepareDB($link)) {
            $error = '';
            mysqli_set_charset($link, "utf8");
            return $link;
        } else {
            $error = 'Ошибка при попытке подключения к базе данных.';
            return false;
        }
    } else {
        $error = 'Ошибка при попытке подключения к серверу баз данных.';
        return false;
    }
}

// очистка значения для предотвращения sql-инъекций
function escapeString(&$link, $value) {
    return mysqli_real_escape_string($link, $value);
}

// добавление информации о новой картинке
function insertImageToDB(&$link, $filename, $img_path, $size) {
    $sql = "insert into images (`filename`, `path`, `size`, `views`) "
            . "values ('$filename','$img_path', $size, 0);";
    return mysqli_query($link, $sql);
}

// получение из базы данных количества просмотров картинки
function getImageViews(&$link, $id) {
    $sql = "select `views` from images where `id` = '$id';";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['views'];
}

// обновление информации о картинке (фиксация просмотра)
function incImageViews(&$link, $id) {
    $sql = "update images set `views` = (`views` + 1) where `id` = '$id';";
    return mysqli_query($link, $sql);
}

// получение массива id-filename
function getImages(&$link) {
    $sql = "select `id`, `filename` from images order by `views` desc;";
    $result = mysqli_query($link, $sql);
    $arr = [];
    if ($result)
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[$row['id']] = $row['filename'];
        }
    return $arr;
}

// получение пути к полноразмерной картинке
function getPathById(&$link, $id) {
    $sql = "select `path` from images where `id`='$id';";
    $result = mysqli_query($link, $sql);    
    while ($row = mysqli_fetch_assoc($result)) {
        return $row['path'];
    }
}

// добавление комментария в базу данных
function insertCommentToDB(&$link, $images_id, $author, $comment) {
    $sql = "insert into comments (`images_id`, `author`, `comment`) "
            . "values ('$images_id', '$author', '$comment');";
    return mysqli_query($link, $sql);    
}

// получение комментариев к картинке
function getComments(&$link, $images_id) {
    $sql = "select `author`, `comment` from `comments` "
            . "where `images_id` = $images_id;";
    $result = mysqli_query($link, $sql);  
    $arr = [];
    if ($result)
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = ['author' => $row['author'], 
                      'comment' => $row['comment']];
        }
    return $arr;
}

// получение массива данных о продуктах
function getProducts(&$link) {
    $sql = "select * from `goods`;";
    $result = mysqli_query($link, $sql);
    $arr = [];
    if ($result)
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
    return $arr;
}

// получение данных о продукте по идентификатору
function getProductById(&$link, $id) {
    $sql = "select `name`, `filename`, `short_descr`, `feature`, "
            . "`long_descr` from goods where `id` = '$id';";
    $result = mysqli_query($link, $sql);
    if ($result)
        while ($row = mysqli_fetch_assoc($result)) {
            return $row;
        }
}