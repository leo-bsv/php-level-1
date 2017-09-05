<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс добавления товара
 *
 */

interface InterfaceCatalogAdd extends InterfaceEntity
{
    const TITLE = 'Добавить товар';
    const LINK = '/catalog/editor';
    const ENTITY = self::API_SERVICE;
    const ACCESS = [self::ADMIN];
}
