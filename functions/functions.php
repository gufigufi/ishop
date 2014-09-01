<?php

defined('ISHOP') or die('Access denied');

/* ===Распечатка массива=== */
function print_arr($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

/* ===Редирект=== */
function redirect(){
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    header("Location: $redirect");
    exit;
}

/* ===Добавление в корзину=== */
function addtocart($goods_id){
    if(isset($_SESSION['cart'][$goods_id])){
        // если в массиве cart уже есть добовляемый товар
        $_SESSION['cart'][$goods_id]['qty'] += 1;
        return $_SESSION['cart'];
    }
    else{
        // если товар кладется в корзину впервые
        $_SESSION['cart'][$goods_id]['qty'] = 1;
        return $_SESSION['cart'];
    }
}

/* ===добавление в корзину=== */
