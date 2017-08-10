<?php
/**
 * Модуль для обработки покупок на сайте
 */

function getUserIdFromSession()
{
    $session = new Session();
    if ($session->active)
        return $session->getUserId();
    else return false;
}

function userExit()
{
    $session = new Session();
    if ($session->active)
        $this->session->stop();
    unset($session);
}

// авторизация пользователя
function userAuthorization(&$link, $login, $pass)
{
    $pass = encryptPassword($pass);
    $sql = "select `id` from `users` where `login` = '$login' and `pass` = '$pass';";
    $user_id = mysqli_query($link, $sql);
    if ($id !== false) {
        $session = new Session();
        $this->session->start($user_id);
    }
}

function getUserById(&$link, $user_id)
{
    $sql = "select `login`, `role` from `users` where `id` = '$user_id';";
    $result = mysqli_query($link, $sql);
    $result = mysqli_fetch_assoc($result);
    if (empty($result))
        return ['login' => 'Гость', 'role' => 0];
    else return $result;
}

// добавление пользователя
function registerUser(&$link, $login, $pass)
{
    $pass = encryptPassword($pass);
    $sql = "insert into `users` (`login`, `pass`, `role`) "
            . "values ('$login', '$pass', '" . R_USER . "');";
    return mysqli_query($link, $sql);    
}

// удаление пользователя
function deleteUser(&$link, $userId)
{
    $sql = "delete from `users` where `id` = $userId;";
    return mysqli_query($link, $sql);
}

// получение списка пользователей
function getUsers(&$link)
{
    $sql = "select `id`, `login` from users;";
    $result = mysqli_query($link, $sql);
    $arr = [];
    if ($result)
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[$row['id']] = $row['login'];
        }
    return $arr;
}

// генерация пароля пользователя
function encryptPassword($param)
{
    $salt_before = "asdfj;qwken klng;s rjehtqh";
    $salt_after = "gw2 4naoiusghdlv5bsmbtjmbxdvgj";
    return md5(md5($salt_before . $param . $salt_after));
}