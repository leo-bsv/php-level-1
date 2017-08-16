<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс базы данных - настройки
 *
 */

interface InterfaceDb
{
    // кодировка вывода сервера MySQL
    const MYSQL_CHARSET = 'utf8';    
    
    // параметры подключения к базе данных
    // хост
    const HOST = 'localhost';
    // пользователь
    const USERNAME = 'root';
    // пароль
    const PASSWORD = 'bla-bla';
    // название базы данных
    const DB_NAME = 'galary';
}
