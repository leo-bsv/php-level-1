<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса каталога
 *
 */

interface InterfaceCatalogIndex extends InterfaceEntity
{
    const MENU_ITEM = 'Каталог';
    const TITLE = 'Интернет-магазин стальных дверей';
    const LINK = '/catalog';
    const ENTITY = self::PRIME_PAGE;
    const ACCESS = [self::GUEST, self::USER, self::ADMIN];
}
