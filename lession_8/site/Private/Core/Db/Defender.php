<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс для очистки запросов к БД
 *
 */

class DbDefender
{  
    // очистка значения для предотвращения sql-инъекций
    static function escapeString($value) {
        return mysqli_real_escape_string(App::$db, $value);
    }
}
