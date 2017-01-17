<?php

declare(strict_types = 1);

namespace Mapper;

/**
 * Class Kernel
 * @package Mapper
 */
class Kernel {

    /**
     * @var array
     */
    private $data;

    /**
     * @var object
     */
    private $object;

    /**
     * Kernel constructor.
     * @param array $data
     * @param object|null $object
     */
    public function __construct(array $data, $object) {
        $this->setData($data)
            ->setObject($object);
    }

    /**
     * @return array
     */
    public function getData(): array {
        return $this->data;
    }

    /**
     * @param array $data
     * @return Kernel
     */
    public function setData(array $data): Kernel {
        $this->data = $data;

        return $this;
    }

    /**
     * @return object
     */
    public function getObject() {
        return $this->object;
    }

    /**
     * @param object $object
     * @return Kernel
     */
    public function setObject($object): Kernel {
        $this->object = $object;

        return $this;
    }

    /**
     * @return object
     */
    public function map() {
        return $this->getObject();
    }

}