<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс управляющий пользователями сайта
 *
 */

class ModelUsers implements InterfaceAccess
{
    private $params;
    
    public function __construct($params = [])
    {
        $this->params = $params;
    }
    
    private function getUserId($login, $pass)
    {
        $pass = $this->encryptPassword($pass);
        $sql = "select `id` from `users` where `login` = '$login' and `pass` = '$pass';";
        $result = mysqli_query(App::$db, $sql);
        $result = mysqli_fetch_assoc($result);
        return $result['id'];
    }
    
    // авторизация пользователя
    public function login($login, $pass)
    {
        $userId = $this->getUserId($login, $pass);
        if ($userId !== false && isset($userId)) {
            App::$session = new Session();
            App::$session->start($userId);    
            return true;
        } else {
            App::Msg('Введены неверные данные.');
            return false;
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
    
    // обновление данных пользователя
    public function update($login, $pass, $email)
    {
        if (!empty($pass)) $pass = $this->encryptPassword($pass);
        $id = App::$session->getUserId();
        if ($id !== false) {
            $sql = "update `users` set";
            $values = [];
            if (!empty($login)) $values[] = " `login`='$login'";
            if (!empty($pass)) $values[] = " `pass`='$pass'";
            if (!empty($email)) $values[] = " `email`='$email'";
            $sql .= implode(',', $values) . " where `id`='$id';";
            return mysqli_real_query(App::$db, $sql);
        }
    }
        
    // уникальный ли логин?
    private function isUnique($fieldName, $fieldValue, $userId='') {
        $sql = "select count(*) as `count` from `users` where `$fieldName`='$fieldValue'";
        if (!empty($userId)) { 
            $sql .= " and `id` != '$userId';";
        } else {
            $sql .= ";";
        }
        $result = mysqli_query(App::$db, $sql);
        $result = mysqli_fetch_assoc($result);
        return $result['count'] == 0 ? true : false;        
    }
    
    // уникальный ли е-мэйл?
    public function emailUnique($email, $userId='') {
        return $this->isUnique('email', $email, $userId);
    }
    
    // уникальный ли логин?
    public function loginUnique($login, $userId='') {
        return $this->isUnique('login', $login, $userId);
    }
    
    // получение логина и роли пользователя по идентификатору 
    public function getUserById($userId)
    {
        $sql = "select `login`, `email`, `role` from `users` where `id` = '$userId';";
        $result = mysqli_query(App::$db, $sql);
        $result = mysqli_fetch_assoc($result);
        if (empty($result))
            return ['login' => 'Гость', 'email' => '', 'role' => self::GUEST];
        else return $result;
    }
    
    // добавление пользователя
    public function registerUser($login, $pass, $email)
    {
        $pass = $this->encryptPassword($pass);
        $sql = "insert into `users` (`login`, `pass`, `email`, `role`) "
                . "values ('$login', '$pass', '$email','" . self::USER . "');";
        if (mysqli_query(App::$db, $sql)) {
            return mysqli_insert_id(App::$db);
        }
    }
    
    // удаление пользователя
    public function deleteUser()
    {
        $userId = $this->params[0];
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
