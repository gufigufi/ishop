<?php

defined('ISHOP') or die('Access denied');

session_start();

// подключение модели
require_once MODEL;

// подключение библиотеки функций
require_once 'functions/functions.php';

// получение массива каталога
$cat = catalog();

// получение массива информеров
$informers = informer();

// получение динамичной части шаблона #content
$view = empty($_GET['view']) ? 'hits' : $_GET['view'];

switch($view){
    case('hits'): //лидеры продаж
        $eyestoppers = eyestopper('hits');
        break;

    case('new'): //новинки
        $eyestoppers = eyestopper('new');
        break;

    case('sale'): //распродажа
        $eyestoppers = eyestopper('sale');
        break;

    case ('cat'): // товары категорий
        $category = abs((int)$_GET['category']);
        $products = products($category); // получаем массив из модели
        break;

    case ('addtocart'):
        // добавление в карзину
        $goods_id = abs((int)$_GET['goods_id']);
        addtocart($goods_id);

        $_SESSION['total_sum'] = total_sum($_SESSION['cart']);

        //количество товара в корзине + защита от ввода несуществующего ID товара
        $_SESSION['total_quantity'] = 0;
        foreach($_SESSION['cart'] as $key => $value){
            if(isset($value['price'])){
                // если получена цена товара из БД - суммируем кол-во
                $_SESSION['total_quantity'] += $value['qty'];
            }
            else{
                // иначе удаляем такой ID из сессии (корзина)
                unset($_SESSION['cart'][$key]);
            }
        }
        redirect();
        break;


    default: //если из адресной строки получено имя несуществующего вида
        $view = 'hits';
        $eyestoppers = eyestopper('hits');
}

// подключени вида
require_once TEMPLATE.'index.php';