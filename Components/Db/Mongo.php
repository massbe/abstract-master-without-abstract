<?php


namespace Components\Db;


class Mongo
{
    public $params;

    public function __construct($params)
    {
        $this->params = $params;
    }
}