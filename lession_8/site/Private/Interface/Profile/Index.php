<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса профиля пользователя
 *
 */

interface InterfaceProfileIndex extends InterfaceEntity
{
    const MENU_ITEM = 'Профиль';
    const TITLE = 'Профиль пользователя';
    const LINK = '/profile';
    const ENTITY = self::PRIME_PAGE;
    const ACCESS = [self::USER, self::ADMIN];
}
