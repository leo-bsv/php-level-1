<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса позволяющего оставить комментарий о картинке
 *
 */

interface InterfaceGalaryPost extends InterfaceEntity
{
    const LINK = '/galary/post';
    const ENTITY = self::API_SERVICE;
    const ACCESS = [self::USER, self::ADMIN];
}
