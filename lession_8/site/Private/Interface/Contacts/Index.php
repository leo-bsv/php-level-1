<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса страницы контактов
 *
 */

interface InterfaceContactsIndex extends InterfaceEntity
{
    const MENU_ITEM = 'Контакты';
    const TITLE = 'Наши контакты';
    const LINK = '/contacts';
    const ENTITY = self::PRIME_PAGE;
    const ACCESS = [self::GUEST, self::USER, self::ADMIN];
}
