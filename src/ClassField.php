<?php

declare(strict_types = 1);

namespace Mapper;

/**
 * Class ClassField
 * @package Mapper
 */
class ClassField {

    /**
     * @var string
     */
    private $setter;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var bool
     */
    private $isAssociative;

    /**
     * @var bool
     */
    private $isSequential;

    /**
     * @var bool
     */
    private $isClass;

    /**
     * @param string $setter
     * @param string $name
     * @param string $type
     * @param bool $isAssociative
     * @param bool $isSequential
     * @param bool $isClass
     */
    public function __construct(
        string $setter,
        string $name,
        string $type = '',
        bool $isAssociative = false,
        bool $isSequential = false,
        bool $isClass = false
    ) {
        $this->setSetter($setter)
            ->setName($name)
            ->setType($type);

        $this->isAssociative = $isAssociative;
        $this->isSequential = $isSequential;
        $this->isClass = $isClass;
    }

    /**
     * @return string
     */
    public function getSetter(): string {
        return $this->setter;
    }

    /**
     * @param string $setter
     * @return ClassField
     */
    public function setSetter(string $setter): ClassField {
        $this->setter = $setter;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ClassField
     */
    public function setName(string $name): ClassField {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }

    /**
     * @param string $type
     * @return ClassField
     */
    public function setType(string $type): ClassField {
        $this->type = $type;

        if (class_exists($type)) {
            $this->setIsClass();
        } elseif ($type === 'array') {
            $this->setIsAssociative();
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isAssociative(): bool {
        return $this->isAssociative;
    }

    /**
     * @return ClassField
     */
    public function setIsAssociative(): ClassField {
        $this->isAssociative = true;

        return $this;
    }

    /**
     * @return ClassField
     */
    public function setIsNotAssociative(): ClassField {
        $this->isAssociative = false;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSequential(): bool {
        return $this->isSequential;
    }

    /**
     * @return ClassField
     */
    public function setIsSequential(): ClassField {
        $this->isSequential = true;

        return $this;
    }

    /**
     * @return ClassField
     */
    public function setIsNotSequential(): ClassField {
        $this->isSequential = false;

        return $this;
    }

    /**
     * @return bool
     */
    public function isClass(): bool {
        return $this->isClass;
    }

    /**
     * @return ClassField
     */
    public function setIsClass(): ClassField {
        $this->isClass = true;

        return $this;
    }

    /**
     * @return ClassField
     */
    public function setIsNotClass(): ClassField {
        $this->isClass = false;

        return $this;
    }

}