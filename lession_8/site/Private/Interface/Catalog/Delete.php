<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс ссылки удаления товара
 *
 */

interface InterfaceCatalogDelete extends InterfaceEntity
{
    const TITLE = 'Удалить товар';
    const LINK = '/catalog/delete/';
    const ENTITY = self::API_SERVICE;
    const ACCESS = [self::ADMIN];
}
