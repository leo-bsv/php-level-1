<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса страницы просмотра товара
 *
 */

interface InterfaceCatalogViewer extends InterfaceEntity
{
    const TITLE = 'Просмотр товара';
    const LINK = '/catalog/viewer';
    const ENTITY = self::EXTRA_PAGE;
    const ACCESS = [self::GUEST, self::USER, self::ADMIN];
}
