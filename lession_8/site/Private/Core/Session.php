<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс сессий
 *
 */

class Session implements InterfaceSession
{
    private $userId;
    public $active = false;    
    private $id;
    
    /**
     * Конструктор сессии
     * Если есть печенька сессии - поднимем сессию
     */    
    public function __construct()
    {    
        if ((isset($_COOKIE[self::SESSION_NAME])) && 
            (!empty($_COOKIE[self::SESSION_NAME])) &&
            (file_exists(self::SESSIONS_PATH . $_COOKIE[self::SESSION_NAME])))
        {           
            $this->active = true;
            $this->id = $_COOKIE[self::SESSION_NAME];            
            $this->userId = file_get_contents(self::SESSIONS_PATH . $this->id);            
        }
    }

    /**
     * Активировать сессию
     */
    public function start($userId)
    {
        // сначала удалим все сессии юзера
        $sessions = array_diff(scandir(self::SESSIONS_PATH), array('..', '.'));
        foreach ($sessions as $session)
        {
            $session_user = trim(file_get_contents(self::SESSIONS_PATH . $session));
            if ($session_user === $userId)
                unlink(self::SESSIONS_PATH . $session);
        }
        // затем сгенерируем новый идентификатор сессии и сохраним её
        $new_session_id = $this->genSessionId();
        $this->id = $new_session_id;
        setcookie(self::SESSION_NAME, $new_session_id, 0, '/', '', false, true);
        file_put_contents(self::SESSIONS_PATH . $new_session_id, $userId);        
        $this->active = true;
    }    
    
    /**
     * Получить ID пользователя
     */
    public function getUserId()
    {
       return $this->userId; 
    }
    
    /**
     * Cгенерировать идентификатор сессии
     */
    private function genSessionId()
    {
        $id = time()+rand(1, 9999999999);
        $id = hash('sha224',$id);
        return $id;
    }      
    
    /**
     * Завершить сессию
     */
    public function stop()
    { 
        unlink(self::SESSIONS_PATH . $this->id);
        setcookie(self::SESSION_NAME, '', time()-3600);            
    }       
}