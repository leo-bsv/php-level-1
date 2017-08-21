<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Корзина покупок
 *
 */

class ControllerCartIndex extends Controller implements InterfaceCartIndex 
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);
        $this->view->addVar('content', $this->view->renderPage('cart'));
    }
}