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
     * @var Parser
     */
    private $parser;

    /**
     * Kernel constructor.
     * @param array $data
     * @param object $object
     */
    public function __construct(array $data, $object) {
        $this->setData($data)
            ->setObject($object)
            ->setupParser();
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

        $class = get_class($this->getObject());
        $this->getParser()->setClass($class);

        return $this;
    }

    /**
     * @param Parser $parser
     * @return Kernel
     */
    protected function setParser(Parser $parser): Kernel {
        $this->parser = $parser;

        return $this;
    }

    /**
     * @return Parser
     */
    protected function getParser(): Parser {
        return $this->parser;
    }

    /**
     * @return Kernel
     */
    private function setupParser(): Kernel {
        $class = get_class($this->getObject());

        return $this->setParser(new Parser($class));
    }

    /**
     * @return object
     */
    public function map() {
        return $this->getObject();
    }

}