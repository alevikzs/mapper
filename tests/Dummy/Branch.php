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
    public function getLength(): float {
        return $this->length;
    }

    /**
     * @param float $length
     * @return Branch
     */
    public function setLength(float $length): Branch {
        $this->length = $length;

        return $this;
    }

    /**
     * @return Leaf[]
     */
    public function getLeaves(): array {
        return $this->leaves;
    }

    /**
     * @param Leaf[] $leaves
     * @return Branch
     */
    public function setLeaves(array $leaves = []): Branch {
        $this->leaves = $leaves;

        return $this;
    }

    /**
     * @param float $length
     * @param array $leaves
     */
    public function __construct(float $length = null, array $leaves = []) {
        $this->length = $length;
        $this->leaves = $leaves;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array {
        return [
            'length' => $this->getLength(),
            'leaves' => $this->getLeaves()
        ];
    }

}