<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Настройки приложения
 *
 */

interface InterfaceConfiguration
{    
    // режим отладки - вывод ошибок в браузер
    const DEBUG_MODE = false; 
    // логирование ошибок в файл
    const ERROR_LOGGING = false;
    // имя файла логов ошибок
    const ERRORS_LOG_FILENAME = 'errors.log';
    // путь к файлу иконки сайта
    const FAVICON_PATH = '/img/favicon.ico';
    
    
    // путь к рабочей папке
    const WORK_PATH = '../Private/';
    // путь к папке интерфейсов
    const INTERFACES_PATH = self::WORK_PATH . 'Interface/';    
    // путь к папке структурных шаблонов
    const TEMPLATES_BONES_PATH = self::WORK_PATH . 'View/Bones/';
    // путь к папке шаблонов страниц
    const TEMPLATES_PAGES_PATH = self::WORK_PATH . 'View/Pages/';
    
    // временная зона
    const TIMEZONE = 'Europe/Moscow';
    // локаль
    const LOCALE = 'en_US.utf-8';    
      
    /**
     * относительные пути к публичным рабочим папкам 
     * (относительно папки Public)
     */
    const IMG_PATH = '/img/';
    const CSS_PATH = '/css/';
    const jS_PATH = '/js/';
    const FONTS_PATH = '/fonts/';
}
