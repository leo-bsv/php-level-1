<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Страница входа на сайт
 *
 */

class ControllerLoginIndex extends Controller implements InterfaceLoginIndex 
{
    public function __construct($params)
    {
        parent::__construct($params);
        
        $login = Request::getValAsStr('login');
        $pass = Request::getValAsStr('pwd');
        
        if (!empty($login) && !empty($pass)) {
            $users = new ModelUsers();
            $users->login($login, $pass);
            if (App::$session->isActive()) header ('Location: /profile');
        }
        
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);
        $this->view->addVar('registrationLink', InterfaceProfileRegister::LINK);
        $this->view->addVar('content', $this->view->renderPage('login'));
    }   
}
