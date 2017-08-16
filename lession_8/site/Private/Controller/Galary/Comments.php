<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс галереи отвечающий за вывод комментариев о картинках
 *
 */

class ControllerGalaryComments implements InterfaceGalaryComments
{
    public function __construct()
    {
        echo 'hello, I`am galary upload script! My link is ' . self::LINK;
    }    
}
