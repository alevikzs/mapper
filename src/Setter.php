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
    private $field;

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
    private $isArray;

    /**
     * @param string $field
     * @param string $name
     * @param string $type
     * @param bool $isArray
     */
    public function __construct(string $field, string $name, string $type, bool $isArray) {
        $this->field = $field;
        $this->name = $name;
        $this->type = $type;
        $this->isArray = $isArray;
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
    public function getType(): string {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Setter
     */
    public function setType(string $type): Setter {
        $this->type = $type;

        return $this;
    }

    /**
     * @return bool
     */
    public function isArray(): bool {
        return $this->type;
    }

    /**
     * @return Setter
     */
    public function setIsArray(): Setter {
        $this->isArray = true;

        return $this;
    }

    /**
     * @return Setter
     */
    public function setIsNotArray(): Setter {
        $this->isArray = false;

        return $this;
    }

}