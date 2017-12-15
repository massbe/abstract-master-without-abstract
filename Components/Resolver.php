<?php

namespace Components;


class Resolver
{
    private $workServices;
    private $bindFromFileParametrs;
    private $instance;

    public function __construct(array $arrayBindFromFile)
    {
        $this->bindFromFileParametrs = $arrayBindFromFile;
    }

    public function bind(string $abstract)
    {
        $this->workServices[$abstract] = $this->getClassBind($abstract);
    }

    public function getClassBind(string $abstract)
    {
        if (!$this->fullNameClassToCreate($abstract)) {
            throw new \Exception('Нельзя создать такой класс');
        }

        $concreteClass = $this->fullNameClassToCreate($abstract);
        return function ($params = []) use ($concreteClass) {
            return new $concreteClass($params);
        };

    }

    public function fullNameClassToCreate(string $classPath): string
    {
        foreach ($this->bindFromFileParametrs as $services) {
            if (key($services) == $classPath) {
                $classForTest = "Components\\" . $services[$classPath];
                if (!class_exists($classForTest)) {
                    throw new \Exception('Нельзя создать такой класс');
                }
                return $classForTest;
            }
        }
    }

    public function get(string $abstract, array $arrayParametrsForClass = null)
    {
        $this->bind($abstract);
        if ($abstract == key($this->bindFromFileParametrs['singletonService'])) {
            if (!isset($this->instance[$abstract])) {
                $this->instance[$abstract] = $this->workServices[$abstract]($arrayParametrsForClass);
            }
            return $this->instance[$abstract];
        } else {
            return $this->workServices[$abstract]($arrayParametrsForClass);
        }
    }
}