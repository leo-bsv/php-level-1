<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Страница профиля пользователя - просмотр и редактирование
 *
 */

class ControllerProfileIndex extends ControllerProfileBase implements InterfaceProfileIndex
{
    public function __construct($params)
    {
        parent::__construct($params);

        $this->action = '/profile';
        $this->title = self::TITLE;
        // если пользователь зарегистрирован
        if (in_array(App::$access, InterfaceProfileIndex::ACCESS)) {
            // обновим информацию в БД
            $userId = App::$session->getUserId();
            $no_errors = true;            
            if ($this->pass !== $this->passr) {
                App::Msg('Пароли не совпадают');
                $no_errors = false;
            }
            if (!empty($this->login) && !$this->users->loginUnique($this->login, $userId)) {
                App::Msg('Логин не уникален - выберите другой логин.');
                $no_errors = false;
            }
            if (!empty($this->email) && !$this->users->emailUnique($this->email, $userId)) {
                App::Msg("Е-мэйл не уникален - выберите другой е-мэйл.");
                $no_errors = false;
            }

            if ($no_errors) {
                $this->users->update($this->login, $this->pass, $this->email);
                // перейдём на страницу профиля
                //header('Location:/profile');
            }                
        }
    }   
}
