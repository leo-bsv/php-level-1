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
        $preparedOrder = $cart->preparedOrder();
        if (is_null($preparedOrder)) {
            $preparedOrder = $cart->prepareOrder();
        }
        $cart->putProductToCart();
        unset($cart);
        App::$appHandler->routing(InterfaceCartIndex::LINK);
    }
}