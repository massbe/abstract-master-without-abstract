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
            throw new \Exception();
        } else {
            if (array_key_exists($service, $this->services)) {
                return $this->create($service);
            } else {
                return $this->createSingleton($service);
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
            throw new \Exception();
        }
        return new $serviceTestAndCreate;
    }

    public function createSingleton($service)
    {
        $serviceSingleton = "Components\\".$this->singletonServices[$service];

        if(!class_exists($serviceSingleton)){
            throw new \Exception();
        }
        if (is_null($this->singletonInstances[$service])) {
            return $this->singletonInstances[$service] = new $serviceSingleton();
        }
        return $this->singletonInstances[$service];
    }
}