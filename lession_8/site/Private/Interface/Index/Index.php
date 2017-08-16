<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса главной страницы галереи
 *
 */

interface InterfaceIndexIndex extends InterfaceEntity
{
    const MENU_ITEM = 'Главная';
    const TITLE = 'Интернет-магазин стальных дверей';
    const LINK = 'index';
    const ENTITY = self::PRIME_PAGE;
    const ACCESS = self::GUEST;
}
