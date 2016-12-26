<?php

declare(strict_types = 1);

namespace Mapper\Kind;

use Mapper\Kind;

/**
 * Class Associative
 * @package Mapper\Kind
 */
class Associative extends Kind {

    /**
     * @var array
     */
    private $array;

    /**
     * Json constructor.
     * @param array $array
     * @param string $class
     */
    public function __construct(array $array, string $class) {
        $this->setArray($array)
            ->setClass($class);
    }

    /**
     * @return array
     */
    public function getArray(): array {
        return $this->array;
    }

    /**
     * @param array $array
     * @return Associative
     */
    public function setArray(array $array): Associative {
        $this->array = $array;

        return $this;
    }

    public function map() {
        // TODO: Implement map() method.
    }

}