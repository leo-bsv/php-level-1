<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Главная страница
 *
 */

class ControllerContactsIndex extends Controller implements InterfaceIndexIndex 
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);
        $this->view->addVar('content', $this->view->renderPage('contacts'));
    }   
}
