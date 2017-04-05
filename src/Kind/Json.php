<?php

declare(strict_types = 1);

namespace Mapper\Kind;

use Mapper\Kind;

/**
 * Class Json
 * @package Mapper\Kind
 */
class Json extends Kind {

    /**
     * Json constructor.
     * @param string $data
     * @param object $object
     */
    public function __construct(string $data, $object) {
        $this->data = $data;

        parent::__construct($object);
    }

    /**
     * @return string
     */
    public function getData(): string {
        return $this->data;
    }

    /**
     * @param string $data
     * @return Json
     */
    public function setData(string $data): Json {
        $this->data = $data;

        $this->getKernel()
            ->setData($this->prepareDataKernel());

        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    protected function prepareDataKernel(): array {
        $data = json_decode($this->getData(), true);

        if (is_null($data)) {
            throw new \Exception('Invalid json passed');
        }

        return $data;
    }

}