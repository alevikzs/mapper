<?php

declare(strict_types = 1);

namespace Mapper;

use \ReflectionClass;
use \ReflectionMethod;

/**
 * Class ClassParser
 * @package Mapper
 */
class ClassParser {

    /**
     * @const string
     */
    const PARAM_SETTER_PATTERN = '/@param\s+(.+)/';

    /**
     * @var string
     */
    private $class;

    /**
     * @var ReflectionClass
     */
    private $reflectionClass;

    /**
     * @param string $class
     */
    public function __construct(string $class) {
        $this->setClass($class);
    }

    /**
     * @return string
     */
    public function getObject() {
        return $this->class;
    }

    /**
     * @param string $class
     * @return ClassParser
     */
    public function setClass(string $class): ClassParser {
        $this->class = $class;

        return $this->setReflectionClass(new ReflectionClass($class));
    }

    /**
     * @return ReflectionClass
     */
    protected function getReflectionClass(): ReflectionClass {
        return $this->reflectionClass;
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @return ClassParser
     */
    private function setReflectionClass(ReflectionClass $reflectionClass): ClassParser {
        $this->reflectionClass = $reflectionClass;

        return $this;
    }

    /**
     * @return Setters
     */
    public function getSetters(): Setters {
        $methods = $this->getReflectionClass()
            ->getMethods();

        $setters = new Setters();

        foreach ($methods as $method) {
            if ($this->isSetterMethod($method)) {
                $setters->add($this->createSetter($method));
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
        $setter = new Setter(
            $method->getName(),
            lcfirst(str_replace('set', '', $method->getName()))
        );

        $this->setupSetterFromAnnotation($setter, $method);

        if (empty($setter->getFieldType())) {
            $this->setSetterTypeFromSignature($setter, $method);
        }

        return $setter;
    }

    /**
     * @param Setter $setter
     * @param ReflectionMethod $method
     * @return ClassParser
     */
    private function setupSetterFromAnnotation(Setter $setter, ReflectionMethod $method): ClassParser {
        preg_match(self::PARAM_SETTER_PATTERN, $method->getDocComment(), $paramTypeAndVariable);

        if (isset($paramTypeAndVariable[1])) {
            $paramParts = preg_split('/\s+/', $paramTypeAndVariable[1], 3, PREG_SPLIT_DELIM_CAPTURE);

            foreach ($paramParts as $paramPart) {
                if (($type = $paramPart[0]) !== '$') {
                    if (strpos($type, '[]') === false) {
                        $setter->setFieldType($type);
                    } else {
                        $setter->setFieldIsSequential()
                            ->setFieldType(str_replace('[]', '', $type));
                    }
                    break;
                }
            }
        }

        return $this;
    }

    /**
     * @param Setter $setter
     * @param ReflectionMethod $method
     * @return ClassParser
     */
    private function setSetterTypeFromSignature(Setter $setter, ReflectionMethod $method): ClassParser {
        $parameters = $method->getParameters();

        if (isset($parameters[0])) {
            $type = (string) $parameters[0]->getType();

            $setter->setFieldType($type);
        }

        return $this;
    }

}