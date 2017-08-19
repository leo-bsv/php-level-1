<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса страницы входа на сайт
 *
 */

interface InterfaceLoginIndex extends InterfaceEntity
{
    const MENU_ITEM = 'Вход';
    const TITLE = 'Вход в интернет-магазин';
    const LINK = '/login';
    const ENTITY = self::PRIME_PAGE;
    const ACCESS = [self::GUEST];
}
