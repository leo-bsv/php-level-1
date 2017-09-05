<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса редактора товара
 *
 */

interface InterfaceCatalogEditor extends InterfaceEntity
{
    const TITLE = 'Редактирование товара';
    const LINK = '/catalog/editor';
    const ENTITY = self::EXTRA_PAGE;
    const ACCESS = [self::ADMIN];
}
