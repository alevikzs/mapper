<?php

declare(strict_types = 1);

namespace Mapper;

/**
 * Class Setter
 * @package Mapper
 */
class Setter {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $fieldType;

    /**
     * @var bool
     */
    private $fieldIsArray;

    /**
     * @var bool
     */
    private $fieldIsClass;

    /**
     * @param string $name
     * @param string $field
     * @param string $fieldType
     * @param bool $fieldIsArray
     * @param bool $fieldIsClass
     */
    public function __construct(
        string $name,
        string $field,
        string $fieldType,
        bool $fieldIsArray,
        bool $fieldIsClass
    ) {
        $this->name = $name;
        $this->field = $field;
        $this->fieldType = $fieldType;
        $this->fieldIsArray = $fieldIsArray;
        $this->fieldIsClass = $fieldIsClass;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Setter
     */
    public function setName(string $name): Setter {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getField(): string {
        return $this->field;
    }

    /**
     * @param string $field
     * @return Setter
     */
    public function setField(string $field): Setter {
        $this->field = $field;

        return $this;
    }

    /**
     * @return string
     */
    public function getFieldType(): string {
        return $this->fieldType;
    }

    /**
     * @param string $fieldType
     * @return Setter
     */
    public function setFieldType(string $fieldType): Setter {
        $this->fieldType = $fieldType;

        return $this;
    }

    /**
     * @return bool
     */
    public function fieldIsArray(): bool {
        return $this->fieldIsArray;
    }

    /**
     * @return Setter
     */
    public function setFieldIsArray(): Setter {
        $this->fieldIsArray = true;

        return $this;
    }

    /**
     * @return Setter
     */
    public function setFieldIsNotArray(): Setter {
        $this->fieldIsArray = false;

        return $this;
    }

    /**
     * @return bool
     */
    public function fieldIsClass(): bool {
        return $this->fieldIsClass;
    }

    /**
     * @return Setter
     */
    public function setFieldIsClass(): Setter {
        $this->fieldIsClass = true;

        return $this;
    }

    /**
     * @return Setter
     */
    public function setFieldIsNotClass(): Setter {
        $this->fieldIsClass = false;

        return $this;
    }

}