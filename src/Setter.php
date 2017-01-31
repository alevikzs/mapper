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
    private $fieldIsAssociative;

    /**
     * @var bool
     */
    private $fieldIsSequential;

    /**
     * @var bool
     */
    private $fieldIsClass;

    /**
     * @param string $name
     * @param string $field
     * @param string $fieldType
     * @param bool $fieldIsAssociative
     * @param bool $fieldIsSequential
     * @param bool $fieldIsClass
     */
    public function __construct(
        string $name,
        string $field,
        string $fieldType = '',
        bool $fieldIsAssociative = false,
        bool $fieldIsSequential = false,
        bool $fieldIsClass = false
    ) {
        $this->setName($name)
            ->setField($field)
            ->setFieldType($fieldType);

        $this->fieldIsAssociative = $fieldIsAssociative;
        $this->fieldIsSequential = $fieldIsSequential;
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

        if (class_exists($fieldType)) {
            $this->setFieldIsClass();
        } elseif ($fieldType === 'array') {
            $this->setFieldIsAssociative();
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function fieldIsAssociative(): bool {
        return $this->fieldIsAssociative;
    }

    /**
     * @return Setter
     */
    public function setFieldIsAssociative(): Setter {
        $this->fieldIsAssociative = true;

        return $this;
    }

    /**
     * @return Setter
     */
    public function setFieldIsNotAssociative(): Setter {
        $this->fieldIsAssociative = false;

        return $this;
    }

    /**
     * @return bool
     */
    public function fieldIsSequential(): bool {
        return $this->fieldIsSequential;
    }

    /**
     * @return Setter
     */
    public function setFieldIsSequential(): Setter {
        $this->fieldIsSequential = true;

        return $this;
    }

    /**
     * @return Setter
     */
    public function setFieldIsNotSequential(): Setter {
        $this->fieldIsSequential = false;

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