<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса галереи, отвечающего за вывод комментариев под картинкой
 *
 */

interface InterfaceGalaryComments extends InterfaceEntity
{
    const LINK = 'galary/comments';
    const ENTITY = self::API_SERVICE;
    const ACCESS = self::GUEST;
}
