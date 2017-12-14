<?php


namespace Components\Db;

class Mysql
{
    public $params;

    public function __construct($params)
    {
        $this->params = $params;
    }
}