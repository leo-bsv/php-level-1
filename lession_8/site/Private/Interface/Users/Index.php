<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса главной страницы галереи
 *
 */

interface InterfaceUsersIndex extends InterfaceEntity
{
    const MENU_ITEM = 'Пользователи';
    const TITLE = 'Список пользователей';
    const LINK = '/users';
    const ENTITY = self::PRIME_PAGE;
    const ACCESS = [self::ADMIN];
}
