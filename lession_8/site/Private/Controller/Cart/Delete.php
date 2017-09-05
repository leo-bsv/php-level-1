<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Контроллер, отвечающий за удаление товара из корзины
 *
 */

class ControllerCartDelete implements InterfaceCartDelete
{
    public function __construct($params)
    {
        $cart = new ModelCart($params);
        $cart->deleteFromCart();
        unset($cart);
        App::$appHandler->routing(InterfaceCartIndex::LINK);
    }
}