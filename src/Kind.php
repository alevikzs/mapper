<?php

declare(strict_types = 1);

namespace Mapper;

/**
 * Class Kind
 * @package Mapper
 */
abstract class Kind implements KindInterface {

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var object
     */
    private $object;

    /**
     * @var Kernel
     */
    private $kernel;

    /**
     * @return array
     */
    abstract protected function prepareDataKernel(): array;

    /**
     * Kind constructor.
     * @param object $object
     */
    public function __construct($object) {
        $this->setObject($object)
            ->setupKernel();
    }

    /**
     * @return object
     */
    public function getObject() {
        return $this->object;
    }

    /**
     * @param object $object
     * @return Kind
     * @throws \Exception
     */
    public function setObject($object): Kind {
        if (is_object($object)) {
            $this->object = $object;

            $this->getKernel()
                ->setObject($object);
        } else {
            throw new \Exception('Invalid object passed');
        }

        return $this;
    }

    /**
     * @return Kernel
     */
    protected function getKernel(): Kernel {
        return $this->kernel;
    }

    /**
     * @param Kernel $kernel
     * @return Kind
     */
    private function setKernel(Kernel $kernel): Kind {
        $this->kernel = $kernel;

        return $this;
    }

    /**
     * @return Kind
     */
    private function setupKernel(): Kind {
        return $this->setKernel(
            new Kernel(
                $this->prepareDataKernel(),
                $this->getObject()
            )
        );
    }

    /**
     * @return object
     */
    public function map() {
        return $this->getKernel()
            ->map();
    }

}