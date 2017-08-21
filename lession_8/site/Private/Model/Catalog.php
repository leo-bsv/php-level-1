<?php

/**
 *
 * Автор: Бурков Сергей aka Leo.
 *
 * Класс управляющий каталогом товаров
 *
 */
class ModelCatalog
{
    private $params;
    
    
    public function __construct($params = [])
    {
        $this->params = $params;
    }   

    
    // получение массива данных о продуктах
    public function getProducts() {
        $sql = "select * from `goods`;";
        $result = mysqli_query(App::$db, $sql);
        $arr = [];
        if ($result)
            while ($row = mysqli_fetch_assoc($result)) {
                $arr[] = $row;
            }
        return $arr;
    }    
    
    // получение данных о продукте по идентификатору
    function getProduct() {
        $productId = $this->params[0];
        $sql = "select * from goods where `id` = '$productId';";
        $result = mysqli_query(App::$db, $sql);
        if ($result)
            while ($row = mysqli_fetch_assoc($result)) {
                return $row;
            }
    }    
    
}
