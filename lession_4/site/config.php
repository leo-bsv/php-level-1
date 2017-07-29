<?php

// папка подключаемых файлов
if (!defined('INCLUDES_DIR')) {
    define('INCLUDES_DIR', 'includes/');
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
