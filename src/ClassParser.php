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
     * @return ClassFields
     */
    public function getClassFields(): ClassFields {
        $methods = $this->getReflectionClass()
            ->getMethods();

        $classFields = new ClassFields();

        foreach ($methods as $method) {
            if ($this->isSetterMethod($method)) {
                $classFields->add($this->createClassField($method));
            }
        }

        return $classFields;
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
     * @return ClassField
     */
    private function createClassField(ReflectionMethod $method): ClassField {
        $classField = new ClassField(
            $method->getName(),
            lcfirst(str_replace('set', '', $method->getName()))
        );

        $this->setupClassFieldFromAnnotation($classField, $method);

        if (empty($classField->getType())) {
            $this->setupClassFieldFromSignature($classField, $method);
        }

        return $classField;
    }

    /**
     * @param ClassField $classField
     * @param ReflectionMethod $method
     * @return ClassParser
     */
    private function setupClassFieldFromAnnotation(ClassField $classField, ReflectionMethod $method): ClassParser {
        preg_match(self::PARAM_SETTER_PATTERN, $method->getDocComment(), $paramTypeAndVariable);

        if (isset($paramTypeAndVariable[1])) {
            $limit = 3;
            $paramParts = preg_split('/\s+/', $paramTypeAndVariable[1], $limit, PREG_SPLIT_DELIM_CAPTURE);

            foreach ($paramParts as $paramPart) {
                if (($type = $paramPart[0]) !== '$') {
                    if (strpos($type, '[]') === false) {
                        $classField->setType($type);
                    } else {
                        $classField->setIsSequential()
                            ->setType(str_replace('[]', '', $type));
                    }

                    break;
                }
            }
        }

        return $this;
    }

    /**
     * @param ClassField $classField
     * @param ReflectionMethod $method
     * @return ClassParser
     */
    private function setupClassFieldFromSignature(ClassField $classField, ReflectionMethod $method): ClassParser {
        $parameters = $method->getParameters();

        if (isset($parameters[0])) {
            $type = (string) $parameters[0]->getType();

            $classField->setType($type);
        }

        return $this;
    }

}