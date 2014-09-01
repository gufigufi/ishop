<?php

defined('ISHOP') or die('Access denied');

// домен
define('PATH', 'http://localhost/ishop/ishop/');

// модель
define('MODEL', 'model/model.php');

// контроллер
define('CONTROLLER', 'controller/controller.php');

// вид
define('VIEW', 'views/');

// папка с активным шаблоном
define('TEMPLATE', VIEW.'ishop/');

// сервер БД
define('HOST', 'localhost');

// пользователь
define('USER', 'root');

// пароль
define('PASS', '19952010');

// БД
define('DB', 'ishop');

// название магазина - title
define('TITLE', 'Интернет магазин сотовых телефонов');

mysql_connect(HOST, USER, PASS) or die('No connect to Server');
mysql_select_db(DB) or die('No connect to DB');
mysql_query("SET NAMES 'UTF8'") or die('Cant set charset');