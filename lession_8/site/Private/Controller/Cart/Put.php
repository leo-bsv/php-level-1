<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Контроллер, отвечающий за добавление товара в корзину
 *
 */

class ControllerCartPut implements InterfaceCartPut
{
    public function __construct($params)
    {
        $cart = new ModelCart($params);
        $cart->putProductToCart();
        //;
    }
}