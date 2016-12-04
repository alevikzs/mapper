<?php

namespace Mapper;

/**
 * Class Setter
 * @package Mapper
 */
class Setter {

    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var string
     */
    private $methodName;

    /**
     * @var string
     */
    private $classValue;

    /**
     * Setter constructor.
     * @param string $fieldName
     * @param string $methodName
     * @param string $classValue
     */
    public function __construct($fieldName, $methodName, $classValue)
    {
        $this->fieldName = $fieldName;
        $this->methodName = $methodName;
        $this->classValue = $classValue;
    }

    /**
     * @return string
     */
    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    /**
     * @param string $fieldName
     * @return Setter
     */
    public function setFieldName(string $fieldName): Setter
    {
        $this->fieldName = $fieldName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return $this->methodName;
    }

    /**
     * @param string $methodName
     * @return Setter
     */
    public function setMethodName(string $methodName): Setter
    {
        $this->methodName = $methodName;
        return $this;
    }

    /**
     * @return string
     */
    public function getClassValue(): string
    {
        return $this->classValue;
    }

    /**
     * @param string $classValue
     * @return Setter
     */
    public function setClassValue(string $classValue): Setter
    {
        $this->classValue = $classValue;
        return $this;
    }

}