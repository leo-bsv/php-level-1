<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Автозагрузчик классов
 *
 */

function autoloader($class)
{        
    if (class_exists($class)) return;
    $path_arr = preg_split("/(?=[A-Z])/", $class);
    $path_arr_lib = array_slice($path_arr, 1);
    $path_arr[0] = __DIR__ . DIRECTORY_SEPARATOR . '..';
    $path = implode(DIRECTORY_SEPARATOR, $path_arr) . '.php';
    if (file_exists($path)) require_once $path;
    else {
        $path_arr_lib = array_merge([__DIR__, '..', 'Core'], $path_arr_lib);        
        $path = implode(DIRECTORY_SEPARATOR, $path_arr_lib) . '.php';
        if (file_exists($path)) require_once $path;
    }
}

spl_autoload_register('autoloader');