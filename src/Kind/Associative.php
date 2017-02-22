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
     * Associative constructor.
     * @param array $data
     * @param object $object
     */
    public function __construct(array $data, $object) {
        $this->setData($data);

        parent::__construct($object);
    }

    /**
     * @return array
     */
    public function getData(): array {
        return $this->data;
    }

    /**
     * @param array $data
     * @return Associative
     */
    public function setData(array $data): Associative {
        $this->data = $data;

        $this->getKernel()
            ->setData($data);

        return $this;
    }

    /**
     * @return array
     */
    protected function prepareDataKernel(): array {
        return $this->getData();
    }

}