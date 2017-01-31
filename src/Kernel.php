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
     * @var ClassParser
     */
    private $classParser;

    /**
     * Kernel constructor.
     * @param array $data
     * @param object $object
     */
    public function __construct(array $data, $object) {
        $this->setData($data)
            ->setObject($object)
            ->setupClassParser();
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
        $this->getClassParser()->setClass($class);

        return $this;
    }

    /**
     * @param ClassParser $parser
     * @return Kernel
     */
    protected function setClassParser(ClassParser $parser): Kernel {
        $this->classParser = $parser;

        return $this;
    }

    /**
     * @return ClassParser
     */
    protected function getClassParser(): ClassParser {
        return $this->classParser;
    }

    /**
     * @return Kernel
     */
    private function setupClassParser(): Kernel {
        $class = get_class($this->getObject());

        return $this->setClassParser(new ClassParser($class));
    }

    /**
     * @return object
     */
    public function map() {
        $setters = $this->getClassParser()->getSetters();

        foreach ($this->getData() as $field => $value) {
            $setter = $setters->getSetter($field);

            if ($setter) {

            } else {
                new \Exception('Field not found');
            }
        }

        return $this->getObject();
    }

    /**
     * @param mixed $value
     * @return bool
     */
    protected function isAssociative($value): bool {
        return is_array($value);
    }

    /**
     * @param array $value
     * @return bool
     */
    private function isSequential(array $value): bool {
        return array_keys($value) === range(0, count($value) - 1);
    }

}