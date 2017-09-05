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
        $cart = new ModelCart($params);
        $goods = $cart->getCartList();
        unset($cart);
        
        $sum = 0;
        foreach ($goods as $product) {
            $sum += $product['price'];
        }
        
        $this->view->addVar('title', self::TITLE);
        $this->view->addVar('h1', self::TITLE);
        $this->view->addVar('goods', $goods);
        $this->view->addVar('sum', $sum);
        $this->view->addVar('content', $this->view->renderPage('cart'));
    }
}