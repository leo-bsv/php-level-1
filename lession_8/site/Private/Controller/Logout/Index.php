<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Контроллер для выхода с сайта, ничего не отображает - просто затирает сессию,
 * куки и параметры приложения привязанные к пользователю.
 *
 */

class ControllerLogoutIndex implements InterfaceLogoutIndex 
{
    public function __construct($params)
    {
        App::$session->stop();
        App::$username = 'Гость';
        App::$access = self::GUEST;
        App::$appHandler->routing(InterfaceIndexIndex::LINK);
    }   
}
