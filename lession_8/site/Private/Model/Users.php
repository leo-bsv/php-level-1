<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс управляющий пользователями сайта
 *
 */

class ModelUsers
{
    // роли пользователей на сайте
    const ROLE_GUEST = 0;  // гость
    const ROLE_USER = 10;  // зарегистрированный пользователь
    const ROLE_ADMON = 20; // администратор
    
    // авторизация пользователя
    public function login($login, $pass)
    {
        $pass = $this->encryptPassword($pass);
        $sql = "select `id` from `users` where `login` = '$login' and `pass` = '$pass';";
        $user_id = mysqli_query(App::$db, $sql);
        if ($id !== false) {
            $session = new Session();
            $this->session->start($user_id);
        } else {
            App::Msg('Введены неверные данные.');
        }
    }

    // выход пользователя из личного кабинета
    public function logout()
    {
        $session = new Session();
        if ($session->active)
            $this->session->stop();
        unset($session);
    }    
    
    // получение идентификатора пользователя из сессии
    public function getUserIdFromSession()
    {
        $session = new Session();
        if ($session->active)
            return $session->getUserId();
        else return false;
    }
    
    // получение логина и роли пользователя по идентификатору 
    public function getUserById($userId)
    {
        $userId = DbDefender::escapeString($userId);
        $sql = "select `login`, `role` from `users` where `id` = '$userId';";
        $result = mysqli_query(App::$db, $sql);
        $result = mysqli_fetch_assoc($result);
        if (empty($result))
            return ['login' => 'Гость', 'role' => 0];
        else return $result;
    }
    
    // добавление пользователя
    public function registerUser($login, $pass)
    {
        $login = DbDefender::escapeString($login);
        $pass = encryptPassword($pass);
        $sql = "insert into `users` (`login`, `pass`, `role`) "
                . "values ('$login', '$pass', '" . self::ROLE_USER . "');";
        return mysqli_query(App::$db, $sql);    
    }
    
    // удаление пользователя
    public function deleteUser($userId)
    {
        $userId = DbDefender::escapeString($userId);
        $sql = "delete from `users` where `id` = $userId;";
        return mysqli_query(App::$db, $sql);
    }    

    // получение списка пользователей
    public function getUsers()
    {
        $sql = "select `id`, `login` from users;";
        $result = mysqli_query(App::$db, $sql);
        $arr = [];
        if ($result)
            while ($row = mysqli_fetch_assoc($result)) {
                $arr[$row['id']] = $row['login'];
            }
        return $arr;
    }    
    
    // генерация пароля пользователя
    private function encryptPassword($param)
    {
        $salt_before = "asdfj;qwken klng;s rjehtqh";
        $salt_after = "gw2 4naoiusghdlv5bsmbtjmbxdvgj";
        return md5(md5($salt_before . $param . $salt_after));
    }
}
