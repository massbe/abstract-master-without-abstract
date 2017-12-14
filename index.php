<?php
include_once ('vendor/autoload.php');
ini_set("xdebug.default_enable", "0");

$bind = include_once ('Components/Config/bind.php');
use Components\Resolver;

try {
    $mysql = new Resolver($bind);
    $mysql->bind('Db');
    $mysql->bind('Monolog');

    $result1 = $mysql->get('Db');
    $result2 = $mysql->get('Db');

    $monolog1 = $mysql->get('Monolog');
    $monolog2 = $mysql->get('Monolog');


    var_dump($result1);
    var_dump($result2);
    var_dump($monolog1);
    var_dump($monolog2);
    var_dump($result1 === $result2);
    var_dump($monolog1 === $monolog2);
} catch (Exception $e) {
    $e->getMessage();
}