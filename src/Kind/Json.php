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
     * @var string
     */
    private $json;

    /**
     * Json constructor.
     * @param string $json
     * @param string $class
     */
    public function __construct(string $json, string $class) {
        $this->setJson($json)
            ->setClass($class);
    }

    /**
     * @return string
     */
    public function getJson(): string {
        return $this->json;
    }

    /**
     * @param string $json
     * @return Json
     */
    public function setJson(string $json): Json {
        $this->json = $json;

        return $this;
    }

    public function map() {
        // TODO: Implement map() method.
    }

}