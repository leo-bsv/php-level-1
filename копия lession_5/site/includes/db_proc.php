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
    
    // проверим наличие таблицы
    $sql = 'show tables;';
    $result = mysqli_query($link, $sql);
    $table_exists = false;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['Tables_in_galary'] == 'images') {
            $table_exists = true; // таблица существует
            break;
        }
    }
    
    // если таблицы не существует - создадим её
    if (!$table_exists) {
        $sql = 'create table if not exists images ('
                . 'id int auto_increment primary key, '
                . 'filename tinytext not null,'
                //. 'filename varchar(255) not null primary key,'
                . 'path text not null, '
                . 'size int not null, '
                . 'views int);';
        if (!mysqli_query($link, $sql)) {
            return false; // не удалось создать таблицу
        }        
    }     
    
    return true;
}

// подключение к базе данных
function connectToDB(&$error){
    $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
    if (isset($link)) {
        if (prepareDB($link)) {
            $error = '';
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

// добавление информации о новой картинке
function insertImageToDB(&$link, $filename, $img_path, $size) {
    $sql = "insert into images (`filename`, `path`, `size`, `views`) "
            . "values ('$filename','$img_path', $size, 0);";
    return mysqli_query($link, $sql);
}

// получение из базы данных количества просмотров картинки
function getImageViews(&$link, $id) {
    $sql = "select views from images where id = '$id';";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['views'];
}

// обновление информации о картинке (фиксация просмотра)
function incImageViews(&$link, $id) {
    $oldViews = getImageViews($link, $id);
    $newViews = $oldViews+1;
    $sql = "update images set views='$newViews' where id='$id';";
    if (mysqli_query($link, $sql)) return $newViews;
}

// получение массива id-filename
function getImages(&$link) {
    $sql = "select id, filename from images;";
    $result = mysqli_query($link, $sql);    
    $arr = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[$row['id']] = $row['filename'];
    }
    return $arr;
}

// получение пути к полноразмерной картинке
function getPathById(&$link, $id) {
    $sql = "select path from images where id='$id';";
    $result = mysqli_query($link, $sql);    
    while ($row = mysqli_fetch_assoc($result)) {
        return $row['path'];
    }
}