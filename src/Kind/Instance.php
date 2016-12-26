<?php

declare(strict_types = 1);

namespace Mapper\Kind;

use Mapper\Kind;

/**
 * Class Instance
 * @package Mapper\Kind
 */
class Instance extends Kind {

    /**
     * @var object
     */
    private $object;

    /**
     * Json constructor.
     * @param object $object
     * @param string $class
     */
    public function __construct($object, string $class) {
        $this->setObject($object)
            ->setClass($class);
    }

    /**
     * @return object
     */
    public function getObject() {
        return $this->object;
    }

    /**
     * @param object $object
     * @return Instance
     */
    public function setObject($object): Instance {
        $this->object = $object;

        return $this;
    }

    public function map() {
        // TODO: Implement map() method.
    }

}