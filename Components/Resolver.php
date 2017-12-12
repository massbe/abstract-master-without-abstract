<?php

namespace Components;


class Resolver
{
    private $services;
    private $singletonServices;
    private $singletonInstances;

    public function __construct(array $array)
    {
        $this->validateArray($array);
    }

    public function get(string $service)
    {
        if ((!array_key_exists($service, $this->services)) && (!array_key_exists($service, $this->singletonServices))){
            throw new \Exception("Заданы значения не найдены в конфигурационном файле");
        } else {
            if (array_key_exists($service, $this->services)) {
                try {
                    return $this->create($service);
                } catch (\Exception $error) {
                    echo $error->getMessage();
                }
            } else {
                try {
                    return $this->createSingleton($service);
                } catch (\Exception $error) {
                    echo $error->getMessage();
                }
            }
        }
    }

    public function validateArray($array)
    {
        foreach ($array as $key => $item) {
            if ($key == 'services') {
                $this->services = $item;
            } else {
                $this->singletonServices = $item;
            }
        }
    }

    public function create($service)
    {
        $serviceTestAndCreate = "Components\\".$this->services[$service];
        if(!class_exists($serviceTestAndCreate)){
            throw new \Exception('Такой класс невозможно создать - экземпляр нигде не найден');
        }
        return new $serviceTestAndCreate();
    }

    public function createSingleton($service)
    {
        $serviceSingleton = "Components\\".$this->singletonServices[$service];
        if(!class_exists($serviceSingleton)){
            throw new \Exception('Такой Синглтонкласс невозможно создать - экземпляр нигде не найден');
        }

        if (is_null($this->singletonInstances[$service])) {
            return $this->singletonInstances[$service] = new $serviceSingleton();
        }
        return $this->singletonInstances[$service];
    }
}