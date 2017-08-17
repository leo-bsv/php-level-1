<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса профиля пользователя
 *
 */

interface InterfaceProfileRegister extends InterfaceEntity
{
    const MENU_ITEM = 'Регистрация';
    const TITLE = 'Регистрация';
    const LINK = 'profile/register';
    const ENTITY = self::PRIME_PAGE;
    const ACCESS = self::GUEST;
}
