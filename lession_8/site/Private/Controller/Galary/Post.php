<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс позволяющий оставить комментарий о картинке и вывести соответствующую
 * форму для комментирования
 *
 */

class ControllerGalaryPost implements InterfaceGalaryPost
{
    public function __construct()
    {
        echo 'hello, I`am galary upload script! My link is ' . self::LINK;
    }
}