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
/* ===Айстопперы - новинки, лидеры продаж, распродажа==== */