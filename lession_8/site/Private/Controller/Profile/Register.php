<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Страница регистрации пользователя
 *
 */

class ControllerProfileRegister extends ControllerProfileBase implements InterfaceProfileRegister
{
    public function __construct($params)
    {
        parent::__construct($params);
        
        $this->title = self::TITLE;                    
        $this->action = '/profile/register';              
        // если пользователь не зарегистрирован
        if (App::$access === InterfaceAccess::GUEST && $this->formSended) {
            // если данные не пустые - зарегистрируем нового пользователя
            if (!empty($this->login) && !empty($this->pass) 
                    && !empty($this->passr) && !empty($this->email)) {
                $no_errors = true;
                if ($this->pass !== $this->passr) {
                    App::Msg('Пароли не совпадают');
                    $no_errors = false;
                }
                if (!$this->users->loginUnique($this->login)) {
                    App::Msg('Логин не уникален - выберите другой логин.');
                    $no_errors = false;
                }
                if (!$this->users->emailUnique($this->email)) {
                    App::Msg("Е-мэйл не уникален - выберите другой е-мэйл.");
                    $no_errors = false;
                }
                
                if ($no_errors) {
                    $userId = $this->users->registerUser($this->login, $this->pass, $this->email);
                    if ($userId) {                    
                        // поднимаем сессию
                        App::$session->start($userId);        
                        // перейдём на страницу профиля
                        header('Location:/profile');
                    }
                }
            }
        }       
    }   
}
