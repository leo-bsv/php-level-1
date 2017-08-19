<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Административная страница дла удаления пользователей
 *
 */

class ControllerUsersIndex extends Controller implements InterfaceUsersIndex 
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);
        $this->view->addVar('content', $this->view->renderPage('index'));
    }   
}
