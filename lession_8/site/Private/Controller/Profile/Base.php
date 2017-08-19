<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Базовый класс для работы с профилем пользователя
 *
 */

class ControllerProfileBase extends Controller
{
    protected $login;
    protected $pass;
    protected $passr;
    protected $email;
    protected $title;
    protected $action;
    protected $users;
    protected $formSended;

    public function __construct($params)
    {
        parent::__construct($params);

        // создадим объект модели для работы с пользователями
        $this->users = new ModelUsers();
        
        // узнаём - обратилась ли к нам форма или страница открыта по ссылке
        $this->formSended = Request::valueExists('login');
        
        // если пришли данные с формы
        if ($this->formSended) {
            $this->login = Request::getValAsStr('login');
            $this->pass = Request::getValAsStr('pwd');
            $this->passr = Request::getValAsStr('pwdr');
            $this->email = Request::getValAsStr('email');
        }
    }   
    
    public function __destruct()
    {
        // если страница открыта по ссылке, получим данные из БД
        if (!$this->formSended) {
            $userId = App::$session->getUserId();
            $userData = $this->users->getUserById($userId);
            $this->login = $userData['login'];
            $this->email = $userData['email'];
        }
        
        $this->view->addVar('title', $this->title);
        $this->view->addVar('h1', $this->title);
        $this->view->addVar('action', $this->action);
        $this->view->addVar('login', $this->login);
        $this->view->addVar('email', $this->email);
        $this->view->addVar('required', $this->action == '/profile' ? '' : 'required=""');
        $this->view->addVar('content', $this->view->renderPage('profile'));        
        parent::__destruct();
    }
}
