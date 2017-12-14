<?php


namespace Components\Monolog;

class Logger
{
    public $params;

    public function __construct($params)
    {
        $this->params = $params;
    }
}