<?php
// кодировка по-умолчанию
//setlocale(LC_ALL, 'en_US.utf-8');

// папка подключаемых файлов
if (!defined('INCLUDES_DIR')) {
    define('INCLUDES_DIR', 'includes/');
}

// папка сессий
if (!defined('SESSIONS_DIR')) {
    define('SESSIONS_DIR', 'sessions/');
}

// папка шаблонов
if (!defined('TEMPLATES_DIR')) {
    define('TEMPLATES_DIR', 'templates/');
    if (!file_exists(TEMPLATES_DIR)) mkdir (TEMPLATES_DIR);    
}

/** 
 * Настройки галереи
 */
// папка галереи
if (!defined('GALARY_DIR')) {
    define('GALARY_DIR', 'galary/');
    if (!file_exists(GALARY_DIR)) mkdir (GALARY_DIR);
}
// папка загружаемых изображений
if (!defined('UPLOADS_DIR')) {
    define('UPLOADS_DIR', GALARY_DIR . 'uploads/');
    if (!file_exists(UPLOADS_DIR)) mkdir (UPLOADS_DIR);
}
// папка миниатюр
if (!defined('THUMBNAILS_DIR')) {
    define('THUMBNAILS_DIR', GALARY_DIR . 'thumbnails/');
    if (!file_exists(THUMBNAILS_DIR)) mkdir (THUMBNAILS_DIR);
}
// поддерживаемые типы загружаемых изображений
if (!defined('SUPPORTED_IMAGE_TYPES')) {
    define('SUPPORTED_IMAGE_TYPES', 'image/jpeg,image/png,image/gif');
}
// поддерживаемые типы загружаемых изображений
if (!defined('SUPPORTED_IMAGE_TYPES')) {
    define('SUPPORTED_IMAGE_TYPES', 'image/jpeg,image/png,image/gif');
}
// высота создаваемой миниатюры
if (!defined('THUMB_WIDTH')) {
    define('THUMB_WIDTH', 70);
}
// ширина создаваемой миниатюры
if (!defined('THUMB_HEIGHT')) {
    define('THUMB_HEIGHT', 150);
}

/**
 * Параметры подключения к СУБД
 */
// хост
if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
}
// имя пользователя
if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}
// пароль пользователя
if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', 'bla-bla');
}
// название БД
if (!defined('DB_NAME')) {
    define('DB_NAME', 'galary');
}

/**
 * Калькулятор
 */
if (!defined('OP_PLUS')) define('OP_PLUS', 0);
if (!defined('OP_MINUS')) define('OP_MINUS', 1);
if (!defined('OP_MULTIPLY')) define('OP_MULTIPLY', 2);
if (!defined('OP_DIVIDE')) define('OP_DIVIDE', 3);

/**
 * Роли пользователей
 */
if (!defined('R_GUEST')) define('R_GUEST', 0);
if (!defined('R_USER')) define('R_USER', 10);
if (!defined('R_ADMIN')) define('R_ADMIN', 20);