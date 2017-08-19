<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Настройки сессий
 *
 */

interface InterfaceSession
{
    // путь к папке сессий
    const SESSIONS_PATH = App::WORK_PATH . 'Sessions/';    
    // название переменной сессии
    const SESSION_NAME = 'SID';   
}
