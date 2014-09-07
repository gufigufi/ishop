<?php

defined('ISHOP') or die('Access denied');

/* ====Каталог - получение массива=== */
function catalog(){
    $query = "SELECT * FROM brands ORDER BY parent_id, brand_name";
    $res = mysql_query($query) or die(mysql_error());
    
    //массив категорий
    $cat = array();
    while($row = mysql_fetch_assoc($res)){
        if(!$row['parent_id']){
            $cat[$row['brand_id']][] = $row['brand_name'];
        }else{
            $cat[$row['parent_id']]['sub'][$row['brand_id']] = $row['brand_name'];
        }
    }
    return $cat;
}

/* ====информеры - получение массива=== */
function informer(){
    $query = "SELECT * FROM links
		INNER JOIN informers ON links.parent_informer = informers.informer_id
		ORDER BY informers.informer_position, links.links_position";
    $res = mysql_query($query) or die(mysql_error());

    $informers = array();
    $name =''; //флаг имени информера
    while($row = mysql_fetch_assoc($res)){
        if($row['informer_name'] != $name){ // если такого информера в массиве еще нет
            $informers[$row['informer_id']][] = $row['informer_name']; // добавляем информер в массив
            $name = $row['informer_name'];
        }
        $informers[$row['parent_informer']]['sub'][$row['link_id']] = $row['link_name']; //заносим страницы в информеры
    }
    return $informers;
}

/* ===Айстопперы - новинки, лидеры продаж, распродажа==== */
function eyestopper($eyestopper){
    $query = "SELECT goods_id, goods.name, goods.img, goods.price FROM goods WHERE visible='1' AND $eyestopper='1'";
    $res = mysql_query($query) or die(mysql_error());

    $eyestoppers = array();
    while($row = mysql_fetch_assoc($res)){
        $eyestoppers[] = $row;
    }

    return $eyestoppers;
}

/* ===Получение массива товаров по категории==== */
function products($category){
    $query = "(SELECT goods_id, name, img, anons, price, hits, new, sale
                    FROM goods
                        WHERE goods_brandid=$category AND visible='1')
                UNION
                (SELECT goods_id, name, img, anons, price, hits, new, sale
                    FROM goods
                        WHERE goods_brandid IN
                        (
                            SELECT brand_id FROM brands WHERE parent_id=$category
                        ) AND visible='1')";
    $res = mysql_query($query) or die(mysql_error());
    $products = array();
    while($row = mysql_fetch_assoc($res)){
        $products[] = $row;
    }
    return $products;
}

/* ===Сумма заказа в корзине + атрибуты товара==== */
function total_sum($goods){
    $total_sum = 0;

    $str_goods = implode(',',array_keys($goods));
    $query = "SELECT goods_id, name, price
                FROM goods
                    WHERE goods_id IN ($str_goods)";
    $res = mysql_query($query) or die(mysql_error());

    while($row = mysql_fetch_assoc($res)){
        $_SESSION['cart'][$row['goods_id']]['name'] = $row['name'];
        $_SESSION['cart'][$row['goods_id']]['price'] = $row['price'];
        $total_sum += $_SESSION['cart'][$row['goods_id']]['qty'] * $row['price'];
    }
    return $total_sum;

}

/* ===Регистрация==== */
function registration(){
    $error = ''; //флаг проверки пустых полей

    $login = mysql_real_escape_string(trim($_POST['login']));
    $pass = trim($_POST['pass']);
    $name = mysql_real_escape_string(trim($_POST['name']));
    $email = mysql_real_escape_string(trim($_POST['email']));
    $phone = mysql_real_escape_string(trim($_POST['phone']));
    $address = mysql_real_escape_string(trim($_POST['address']));

    if(empty($login)) $error .= '<li>Не указан логин</li>';
    if(empty($pass)) $error .= '<li>Не указан пароль</li>';
    if(empty($name)) $error .= '<li>Не указано ФИО</li>';
    if(empty($email)) $error .= '<li>Не указан Email</li>';
    if(empty($phone)) $error .= '<li>Не указан телефон</li>';
    if(empty($address)) $error .= '<li>Не указан адрес</li>';

    if(empty($error)){
        //если все поля заполнены

    }
    else{
        //если не заполнены обязательные поля
        $_SESSION['reg']['res'] = "Не заполнены обязательные поля: <ul> $error </ul>";
        $_SESSION['reg']['login'] = $login;
        $_SESSION['reg']['name'] = $name;
        $_SESSION['reg']['email'] = $email;
        $_SESSION['reg']['phone'] = $phone;
        $_SESSION['reg']['address'] = $address;
    }
}

/* ===Регистрация==== */