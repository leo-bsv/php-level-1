<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс описывающий действие выхода с сайта
 *
 */

interface InterfaceLogoutIndex extends InterfaceEntity
{
    const MENU_ITEM = 'Выйти';
    const TITLE = '';
    const LINK = '/logout';
    const ENTITY = self::PRIME_PAGE;
    const ACCESS = [self::USER];
}
