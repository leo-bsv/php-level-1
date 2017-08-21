<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса главной страницы галереи
 *
 */

interface InterfaceGalaryIndex extends InterfaceEntity
{
    const MENU_ITEM = 'Галерея';
    const TITLE = 'Галерея изображений пользователей';
    const LINK = '/galary';
    const ENTITY = self::PRIME_PAGE;
    const ACCESS = [self::GUEST, self::USER, self::ADMIN];   
}
