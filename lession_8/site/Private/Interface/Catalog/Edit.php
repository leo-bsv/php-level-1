<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс ссылки редактирования товара
 *
 */

interface InterfaceCatalogEdit extends InterfaceEntity
{
    const TITLE = 'Редактировать товар';
    const LINK = '/catalog/editor/';
    const ENTITY = self::API_SERVICE;
    const ACCESS = [self::ADMIN];
}
