<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Интерфейс класса сервиса удаления пользователя
 *
 */

interface InterfaceUsersDelete extends InterfaceEntity
{
    const LINK = '/users/delete';
    const ENTITY = self::API_SERVICE;
    const ACCESS = [self::ADMIN];
}
