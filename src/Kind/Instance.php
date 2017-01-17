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
     * Instance constructor.
     * @param object $data
     * @param object $object
     */
    public function __construct($data, $object) {
        $this->setData($data);

        parent::__construct($object);
    }

    /**
     * @return object
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param object $data
     * @return Instance
     * @throws \Exception
     */
    public function setData($data): Instance {
        if (is_object($data)) {
            $this->data = $data;
        } else {
            throw new \Exception('Invalid object passed');
        }

        return $this;
    }

    /**
     * @return array
     */
    protected function prepareDataKernel(): array {
        return (array) $this->getData();
    }

}