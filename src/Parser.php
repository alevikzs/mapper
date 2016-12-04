<?php

namespace Mapper;

use \ReflectionClass;

/**
 * Class Parser
 * @package Mapper
 */
class Parser {

    /**
     * @var object
     */
    private $object;

    /**
     * @var ReflectionClass
     */
    private $reflectionClass;

    /**
     * Parser constructor.
     * @param object $object
     */
    public function __construct(object $object) {
        $this->setObject($object);
    }

    /**
     * @return object
     */
    public function getObject(): object {
        return $this->object;
    }

    /**
     * @param object $object
     * @return Parser
     */
    public function setObject(object $object): Parser {
        $this->object = $object;

        return $this->setReflectionClass(new ReflectionClass($object));
    }

    /**
     * @return ReflectionClass
     */
    protected function getReflectionClass(): ReflectionClass {
        return $this->reflectionClass;
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @return Parser
     */
    private function setReflectionClass(ReflectionClass $reflectionClass): Parser {
        $this->reflectionClass = $reflectionClass;

        return $this;
    }



}