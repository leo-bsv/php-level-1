<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Страница профиля пользователя - просмотр и редактирование
 *
 */

class ControllerProfileIndex extends Controller implements InterfaceProfileIndex 
{
    public function __construct($params)
    {
        parent::__construct($params);

        // создадим объект модели для работы с пользователями
        $users = new ModelUsers();
        
        // узнаём - обратилась ли к нам форма или страница открыта по ссылке
        $formSended = Request::valueExists('login');
        
        // если пришли данные с формы
        if ($formSended) {
            $login = Request::getValAsStr('login');
            $pass = Request::getValAsStr('pwd');
            $email = Request::getValAsStr('email');
        }
        
        // если данные не пустые - обновим информацию в БД
        if (App::$access > InterfaceAccess::GUEST) {
            if (!empty($login) && !empty($pass) && !empty($email)) {
                $users->update($login, $pass, $email);
                $title = self::TITLE;
            }
        } else {
            if (!empty($login) && !empty($pass) && !empty($email)) {
                $users->registerUser($login, $pass, $email);
                $title = 'Регистрация';
            }
        }
        $h1 = $title;
        
        // если страница открыта по ссылке, получим данные из БД
        if (!$formSended) {
            $userId = $users->getUserIdFromSession();
            $userData = $users->getUserById($userId);
            $login = $userData['login'];
            $email = $userData['email'];
        }
        
        $this->view->addVar('title', $title);
        $this->view->addVar('h1', $title);
        $this->view->addVar('login', $login);
        $this->view->addVar('email', $email);
        $this->view->addVar('content', $this->view->renderPage('profile'));
    }   
}
