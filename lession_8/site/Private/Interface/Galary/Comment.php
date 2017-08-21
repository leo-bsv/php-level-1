<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса галереи, отвечающего за добавление комментария
 *
 */

interface InterfaceGalaryComment extends InterfaceEntity
{
    const LINK = '/galary/comment';
    const ENTITY = self::API_SERVICE;
    const ACCESS = [self::USER, self::ADMIN];
}
