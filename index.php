<?php
include_once ("vendor/autoload.php");

$config = include_once ('Components/Config/bind.php');

use Components\Resolver;

$resolve = new Resolver($config);

try {
    $db1 = $resolve->get('Db');
    $db2 = $resolve->get('Db');

    $service1 = $resolve->get('Monolog');
    $service2 = $resolve->get('Monolog');
} catch (Exception $error) {
    echo $error->getMessage();
}

var_dump($db1 === $db2);
var_dump($service1 === $service2);