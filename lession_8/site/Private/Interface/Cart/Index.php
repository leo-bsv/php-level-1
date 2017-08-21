<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса главной страницы галереи
 *
 */

interface InterfaceCartIndex extends InterfaceEntity
{
    const MENU_ITEM = 'Корзина';
    const TITLE = 'Интернет-магазин стальных дверей';
    const LINK = '/cart';
    const ENTITY = self::PRIME_PAGE;
    const ACCESS = [self::USER, self::ADMIN];
}
