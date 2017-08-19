<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса главной страницы галереи
 *
 */

interface InterfaceGalaryViewer extends InterfaceEntity
{
    const MENU_ITEM = '';
    const TITLE = 'Просмотр изображения';
    const LINK = '/galary/viewer';
    const ENTITY = self::EXTRA_PAGE;
    const ACCESS = [self::GUEST, self::USER,  self::ADMIN];
}
