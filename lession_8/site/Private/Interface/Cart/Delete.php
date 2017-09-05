<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса удаляющего товар из корзины
 *
 */

interface InterfaceCartDelete extends InterfaceEntity
{
    const LINK = '/cart/delete';
    const ENTITY = self::API_SERVICE;
    const ACCESS = [self::USER, self::ADMIN];
}
