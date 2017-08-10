<?php
/**
 * Модуль для обработки покупок на сайте
 */

// добавление товара в корзину
function addProductToCart(&$link, $productId, $price, $quantity)
{
    //
}

// удаление товара из корзины
function delProductFromCart(&$link, $productId)
{
    //
}

// получение списка товаров, находящихся в корзине
function getCartList(&$link)
{
    $sql = "select `views` from images where `id` = '$id';";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['views'];
}