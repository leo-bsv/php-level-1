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
    const TITLE = 'Регистрация на сайте';
    const LINK = '/profile/register';
    const ENTITY = self::EXTRA_PAGE;
    const ACCESS = [self::GUEST];
}
