<?php

namespace Mapper;

use \ReflectionClass;
use \ReflectionMethod;

/**
 * Class Parser
 * @package Mapper
 */
class Parser {

    /**
     * @const string
     */
    const PARAM_SETTER_PATTERN = '/@param\s+(.+)/';

    /**
     * @var object
     */
    private $object;

    /**
     * @var ReflectionClass
     */
    private $reflectionClass;

    /**
     * @param object $object
     */
    public function __construct($object) {
        $this->setObject($object);
    }

    /**
     * @return object
     */
    public function getObject() {
        return $this->object;
    }

    /**
     * @param object $object
     * @return Parser
     */
    public function setObject($object): Parser {
        $this->object = $object;

        return $this->setReflectionClass(new ReflectionClass($object));
    }

    /**
     * @return ReflectionClass
     */
    protected function getReflectionClass(): ReflectionClass {
        return $this->reflectionClass;
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @return Parser
     */
    private function setReflectionClass(ReflectionClass $reflectionClass): Parser {
        $this->reflectionClass = $reflectionClass;

        return $this;
    }

    /**
     * @return Setter[]
     */
    public function getSetters(): array {
        $methods = $this->getReflectionClass()->getMethods();

        $setters = [];

        foreach ($methods as $method) {
            if ($this->isSetterMethod($method)) {
                $setters[] = $this->createSetter($method);
            }
        }

        return $setters;
    }

    /**
     * @param ReflectionMethod $method
     * @return bool
     */
    private function isSetterMethod(ReflectionMethod $method): bool {
        $name = $method->getName();

        return strpos($name, 'set') !== false;
    }

    /**
     * @param ReflectionMethod $method
     * @return Setter
     */
    private function createSetter(ReflectionMethod $method): Setter {
        $fieldName = lcfirst(str_replace('set', '', $method->getName()));

        preg_match(self::PARAM_SETTER_PATTERN, $method->getDocComment(), $paramTypeAndVariable);

        $isArray = false;
        $type = null;

        if (isset($paramTypeAndVariable[1])) {
            $paramParts = preg_split('/\s+/', $paramTypeAndVariable[1], 3, PREG_SPLIT_DELIM_CAPTURE);
            $type = null;
            foreach ($paramParts as $paramPart) {
                if ($paramPart[0] !== '$') {
                    $isArray = false;
                    $type = $paramPart;
                    if (strpos($paramPart, '[]') !== false) {
                        $isArray = true;
                        $type = str_replace('[]', '', $type);
                    } elseif ($type === 'array') {
                        $isArray = true;
                    }
                    break;
                }
            }
        }

        return new Setter(
            $fieldName,
            $method->getName(),
            $type,
            $isArray
        );
    }

}