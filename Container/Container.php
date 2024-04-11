<?php

namespace App\Container;

use App\Classes\Lower;
use App\Container\Exceptions\ContainerException;

class Container
{
    private $services = [];
    
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }

    public function add(string $id, string|object $concrete = null): self
    {
        //Если передаётся имя класса без конкретной реализации,
        //то записываем его как concrete
        if (!$concrete && class_exists($id)) {
            $concrete = $id;
        }

        $this->services[$id] = $concrete;

        return $this;
    }

    public function get(string $id)
    {
        if (!$this->has($id)){ //Если сервис не зарегистрирован в контейнере
            throw new ContainerException("Сервис '$id' не зарегистрирован в сервис-контейнере");
        }

        $service = $this->services[$id];
        //Если это ф-ция, то выполняем
        if ($service instanceof \Closure){
            return $service();
        }
        //Если это уже готовый объект, то возвращаем этот экземпляр
        if (is_object($service)){
            return $service;
        }

        //Если это класс, то реализуем объект со всеми зависимостями
        if (class_exists($service)){
            return $this->resolve($service);
        }

        //Иначе просто возвращаем содержимое
        return $this->services[$id];
    }

    private function resolve(string $service): object
    {
        $reflection = new \ReflectionClass($service);
        $constructor = $reflection->getConstructor();
        if ($constructor){
            $constructorParams = $constructor->getParameters();
            //Получаем все зависимости из конструктора
            $dependencies = $this->getDependencies($constructorParams);
            //Создаём нужный сервис передав все зависимости
            return $reflection->newInstanceArgs($dependencies);
        }

        //Если конструктора нет, то возвращаем экземпляр класса
        return $reflection->newInstance();
    }

    private function getDependencies($constructorParams):array
    {
        $dependencies = [];
        foreach ($constructorParams as $param) {
            $class = $param->getType()->getName();
            //Рекурсией ищем зависимости зависимостей (до первого класса без конструктора)
            $dependencies[] = $this->resolve($class);
        }

        return $dependencies;
    }
}