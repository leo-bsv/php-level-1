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
        return mysqli_fetch_assoc($result);
    }
    
    // подготовим новый заказ, который будет выполнять функцию корзины
    public function prepareOrder()
    {
        $sql = "insert into `orders` (`buyers_id`, `status`) values ({$this->userId}, ".self::ORDER_PREPARE.");";
        return mysqli_query(App::$db, $sql);
    }

    // добавление товара в корзину
    public function putProductToCart()
    {
        $productId = $this->params[0];
                     
        mysqli_autocommit(App::$db, false);
        mysqli_begin_transaction(App::$db);  
        $sql = "select @orders_id:=`id` from `orders` where `buyers_id` = '{$this->userId}' and `status` = '".self::ORDER_PREPARE."';";
        mysqli_query(App::$db, $sql);    
        $sql = "insert into `sold_goods` (`orders_id`, `goods_id`, `quantity`) values (@orders_id, '$productId', '1');";                
        mysqli_query(App::$db, $sql);
        mysqli_commit(App::$db);
    }
    
    // получение списка товаров, находящихся в корзине
    public function getCartList()
    {
        mysqli_autocommit(App::$db, false);
        mysqli_begin_transaction(App::$db);
        $sql = "select @orders_id:=`id` from orders where `buyers_id` = '{$this->userId}' and `status`='".self::ORDER_PREPARE."';";
        mysqli_query(App::$db, $sql);    
        $sql = "select `id`, `goods_id`, `name`, `quantity`, `price` from sold_goods inner join goods using (goods_id) where orders_id=@orders_id order by goods_id;";               
        $result = mysqli_query(App::$db, $sql);    
        mysqli_commit(App::$db);
        $arr = [];
        if ($result)
            while ($row = mysqli_fetch_assoc($result)) {
                $arr[] = ['id' => $row['id'],
                          'goods_id' => $row['goods_id'],
                          'name' => $row['name'],
                          'price' => $row['price']];
            }
        return $arr;               
    }
    
    // удаление товара из корзины
    public function deleteFromCart()
    {
        $productId = $this->params[0];
        $preparedOrder = $this->preparedOrder();
        $sql = "delete from `sold_goods` where `id`='$productId' and `orders_id`='{$preparedOrder['id']}';";
        mysqli_query(App::$db, $sql);
    }
}
