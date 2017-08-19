<?php
class Access implements InterfaceAccess
{    
    public function __construct()
    {        
        if (App::$session->isActive()) {
            $userId = App::$session->getUserId();
            $users = new ModelUsers();
            $user = $users->getUserById($userId);
            App::$access = $user['role'];
            App::$username = $user['login'];
        } else {
            App::$access = self::GUEST;
            App::$username = 'Гость';
        }
    }        
}