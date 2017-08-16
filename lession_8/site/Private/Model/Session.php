<?php

/**
 * Session - Класс сессий
 */
class Session
{
    private $user_id;
    public $active = false;    
    private $id;
    
    /**
     * Конструктор сессии
     * Если есть печенька сессии - поднимем сессию
     */    
    public function __construct()
    {    
        if ((isset($_COOKIE[SESSION_NAME])) && 
            (!empty($_COOKIE[SESSION_NAME])) &&
            (file_exists(SESSIONS_DIR . $_COOKIE[SESSION_NAME])))
        {           
            $this->active = true;
            $this->id = $_COOKIE[SESSION_NAME];            
            $this->user_id = file_get_contents(SESSIONS_DIR . $this->id);            
        }
    }

    /**
     * Активировать сессию
     */
    public function start($user_id)
    {
        // сначала удалим все сессии юзера
        $sessions = array_diff(scandir(SESSIONS_DIR), array('..', '.'));
        foreach ($sessions as $session)
        {
            $session_user = trim(file_get_contents(SESSIONS_DIR . $session));
            if ($session_user === $user_id)
                unlink(SESSIONS_DIR . $session);
        }
        // затем сгенерируем новый идентификатор сессии и сохраним её
        $new_session_id = $this->genSessionId();
        $this->id = $new_session_id;
        setcookie(SESSION_NAME, $new_session_id, 0, '/', '', false, true);
        file_put_contents(SESSIONS_DIR . $new_session_id, $user_id);        
        $this->active = true;
    }    
    
    /**
     * Получить имя пользователя
     */
    public function getUserId()
    {
       return $this->user_id; 
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
        unlink(SESSIONS_DIR . $this->id);        
        setcookie(SESSION_NAME, '', time()-3600);            
    }       
}