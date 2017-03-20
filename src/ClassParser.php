<?php

declare(strict_types = 1);

namespace Mapper;

use \Reflection\ClassUseStatements as ReflectionClass;
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
    public function getClass() {
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
            $types = preg_split(
                '/\s+/',
                $paramTypeAndVariable[1],
                $limit = 3,
                PREG_SPLIT_DELIM_CAPTURE
            );

            foreach ($types as $type) {
                if ($type[0] !== '$') {
                    if (strpos($type, '[]') !== false) {
                        $classField->setIsSequential();

                        $type = str_replace('[]', '', $type);
                    }

                    $this->setupClassFieldType($classField, $type);

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

    /**
     * @param ClassField $classField
     * @param string $type
     * @return ClassParser
     */
    private function setupClassFieldType(ClassField $classField, string $type): ClassParser {
        if ($this->typeIsNotStandard($type)) {
            $fullClassName = $this->getReflectionClass()
                ->getUseStatements()
                ->getFullClassName($type);

            if ($fullClassName) {
                $type = $fullClassName;
            } else {
                $type = "{$this->getReflectionClass()->getNamespaceName()}\\$type";
            }
        }

        $classField->setType($type);

        return $this;
    }

    /**
     * @param string $type
     * @return bool
     */
    private function typeIsNotStandard(string $type): bool {
        return !in_array($type, array('int', 'string', 'float', 'bool', 'array'));
    }

}