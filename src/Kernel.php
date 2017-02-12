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
        $classFields = $this->getClassParser()->getClassFields();

        foreach ($this->getData() as $field => $value) {
            $classField = $classFields->getClassField($field);

            $valueToMap = $this->buildValueToMap($value, $classField);

            if (!is_null($valueToMap)) {
                $this
                    ->getObject()
                    ->{$classField->getSetter()}($valueToMap);
            }

            if ($classField) {

            } else {
                new \Exception('Field not found');
            }
        }

        return $this->getObject();
    }

    /**
     * @param mixed $value
     * @param ClassField $classField
     * @return mixed
     * @throws \Exception
     */
    private function buildValueToMap($value, ClassField $classField) {
        $valueToMap = $value;

        if ($this->isArray($value)) {
            if ($this->isClass($value)) {
                if ($classField->isClass()) {
                    $type = $classField->getType();

                    $valueToMap = (new static($value, new $type()))->map();
                } else {
                    throw new \Exception('Not class');
                }
            } else {
                if ($classField->isSequential()) {
                    $valueToMap = array_map(function($value) use (
                        $classField
                    ) {
                        return (new static($value, $classField))->map();
                    }, $value);
                } else {
                    throw new \Exception('Not sequential');
                }
            }
        } else {
            if ($classField->isNotSimple()) {
                throw new \Exception('Not simple');
            }
        }

        return $valueToMap;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    protected function isArray($value): bool {
        return is_array($value);
    }

    /**
     * @param array $value
     * @return bool
     */
    protected function isClass(array $value): bool {
        return !$this->isSequential($value);
    }

    /**
     * @param array $value
     * @return bool
     */
    protected function isSequential(array $value): bool {
        return array_keys($value) === range(0, count($value) - 1);
    }

}