<?php
include_once ("vendor/autoload.php");
$config = include_once ('Components/bind.php');

use Components\Resolver;

$resolve = new Resolver($config);

$db = $resolve->get('Db');
$db1 = $resolve->get('Db');

$logger1 = $resolve->get('Monolog');
$logger2 = $resolve->get('Monolog');

var_dump($db === $db1);
var_dump($logger1 === $logger2);