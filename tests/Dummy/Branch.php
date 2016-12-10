<?php

namespace Tests\Dummy;

use \JsonSerializable;

/**
 * Class Branch
 * @package Tests\Dummy
 */
class Branch implements JsonSerializable {

    /**
     * @var double
     */
    private $length;

    /**
     * @var Leaf[]
     */
    private $leaves;

    /**
     * @return float
     */
    public function getLength() {
        return $this->length;
    }

    /**
     * @param float $length
     * @return $this
     */
    public function setLength($length) {
        $this->length = $length;

        return $this;
    }

    /**
     * @return Leaf[]
     */
    public function getLeaves() {
        return $this->leaves;
    }

    /**
     * @param Leaf[] $leaves
     * @return $this
     */
    public function setLeaves(array $leaves = []) {
        $this->leaves = $leaves;

        return $this;
    }

    /**
     * @param double $length
     * @param array $leaves
     */
    public function __construct($length = null, array $leaves = []) {
        $this->length = $length;
        $this->leaves = $leaves;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return [
            'length' => $this->getLength(),
            'leaves' => $this->getLeaves()
        ];
    }

}