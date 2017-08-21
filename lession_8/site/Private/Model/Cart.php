<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс управляющий корзиной
 *
 */

class ModelCart implements InterfaceAccess
{
    private $params;
    private $userId;
    
    // стадии заказа
    const ORDER_PREPARE = 0;
    const ORDER_IN_PROCESS = 1;
    const ORDER_PROCESSED = 2;
    
    public function __construct($params = [])
    {
        $this->params = $params;
        $this->userId = App::$session->getUserId();
    }
    
    // проверяем наличие подготовленного и не обработанного заказа
    // будем добавлять в него данные - он будет нашей корзиной
    public function preparedOrder()
    {
        $sql = "select `id` from `orders` where `buyers_id` = '{$this->userId}' and `status` = '".self::ORDER_PREPARE."';";
        $result = mysqli_query(App::$db, $sql);
        $result = mysqli_fetch_assoc($result);
        return $result;
    }

    public function putProductToCart()
    {
        $productId = $this->params[0];
        
        $sql = "select @price:=`price` from `goods` where `id` = '$productId';"
                . "select @orders_id:=`id` from `orders` where `buyers_id` = '{$this->userId}' and `status` = '".self::ORDER_PREPARE."';"
                . "insert into `sold_goods` (`orders_id`, `price`, `quantity`) "
                . "values (@orders_id, @price, '1');";
        return mysqli_query(App::$db, $sql);        
    }
    
    // получение списка товаров, находящихся в корзине
    public function getCartList()
    {
        $sql = "select * from `sold_goods` where `orders_id`=(select `id` from orders where `buyers_id` = '{$this->userId}' and `status`='".self::ORDER_PREPARE."');";
        $result = mysqli_query(App::$db, $sql);
        $result = mysqli_fetch_assoc($result);
        return $result;
    }
}
