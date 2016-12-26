<?php

declare(strict_types = 1);

namespace Mapper;

/**
 * Class Kind
 * @package Mapper
 */
abstract class Kind implements KindInterface {

    /**
     * @var string
     */
    private $class;

    /**
     * @return string
     */
    public function getClass(): string {
        return $this->class;
    }

    /**
     * @param string $class
     * @return Kind
     */
    public function setClass(string $class): Kind {
        $this->class = $class;

        return $this;
    }

}