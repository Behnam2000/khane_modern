<?php

declare(strict_types=1);

namespace Core;

use Exception;
use ReflectionClass;
use ReflectionNamedType;

class Container
{
    private array $definitions = [];
    private array $resolved = [];

    public function addDefinitions(array $containerDefinitions)
    {
        $this->definitions = [...$this->definitions, ...$containerDefinitions];
    }

    public function resolve($className)
    {
        $reflectionClass = new ReflectionClass($className);

        if (!$reflectionClass->isInstantiable()) {
            throw new Exception("not instantiable");
        }

        $construct = $reflectionClass->getConstructor();

        if (!$construct) {
            return new $className();
        }

        $parameters = $construct->getParameters();

        if (count($parameters) === 0) {
            return new $className();
        }

        $dependencies = [];

        foreach ($parameters as $param) {
            $paramName = $param->getName();
            $paramType = $param->getType();

            if (!$paramType) {
                throw new Exception("the parameter {$paramName} has no specified type");
            }

            if (!$paramType instanceof ReflectionNamedType || $paramType->isBuiltin()) {
                if ($param->isDefaultValueAvailable()) {
                    return $param->getDefaultValue();
                }
            }

            $dependencies[] = $this->get($paramType->getName());
        }

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    public function get($id)
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new Exception("Class {$id} is not exist");
        }

        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        $factory = $this->definitions[$id];

        $dependency = $factory();

        $this->resolved[$id] = $dependency;

        return $dependency;
    }
}
