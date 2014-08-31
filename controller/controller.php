<?php

defined('ISHOP') or die('Access denied');

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


    default: //если из адресной строки получено имя несуществующего вида
        $view = 'hits';
        $eyestoppers = eyestopper('hits');
}

// подключени вида
require_once TEMPLATE.'index.php';