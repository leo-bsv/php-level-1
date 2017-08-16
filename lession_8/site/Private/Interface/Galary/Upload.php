<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса подгрузки изображений
 *
 */

interface InterfaceGalaryUpload extends InterfaceEntity
{
    const LINK = 'galary/upload';
    const ENTITY = self::API_SERVICE;
    const ACCESS = self::USER;
}
