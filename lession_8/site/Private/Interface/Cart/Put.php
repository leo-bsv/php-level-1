<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса добавляющего товар в корзину
 *
 */

interface InterfaceCartPut extends InterfaceEntity
{
    const LINK = '/cart/put';
    const ENTITY = self::API_SERVICE;
    const ACCESS = [self::USER, self::ADMIN];
}
