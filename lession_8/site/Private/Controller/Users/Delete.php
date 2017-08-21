<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * API-метод для удаления пользователя
 *
 */

class ControllerUsersDelete implements InterfaceUsersDelete
{
    public function __construct($params)
    {
        $users = new ModelUsers($params);
        $users->deleteUser();
        App::$appHandler->routing(InterfaceUsersIndex::LINK);
    }   
}
