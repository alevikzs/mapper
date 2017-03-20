<?php

namespace Mapper\Tests\Dummy\Tree;

use \Mapper\Tests\Dummy\Tree\Branch\{Leaf, Fruit};

/**
 * Class Branch
 * @package Mapper\Tests\Dummy\Tree
 */
class Branch {

    /**
     * @var Leaf[]
     */
    private $leaves;

    /**
     * @var Fruit[]
     */
    private $fruits;

    /**
     * @var float
     */
    private $height;

    /**
     * @var float
     */
    private $width;

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
    public function setLeaves(array $leaves): Branch {
        $this->leaves = $leaves;
        return $this;
    }

    /**
     * @return Fruit[]
     */
    public function getFruits(): array {
        return $this->fruits;
    }

    /**
     * @param Fruit[] $fruits
     * @return Branch
     */
    public function setFruits(array $fruits): Branch {
        $this->fruits = $fruits;
        return $this;
    }

    /**
     * @return float
     */
    public function getHeight(): float {
        return $this->height;
    }

    /**
     * @param float $height
     * @return Branch
     */
    public function setHeight(float $height): Branch {
        $this->height = $height;
        return $this;
    }

    /**
     * @return float
     */
    public function getWidth(): float {
        return $this->width;
    }

    /**
     * @param float $width
     * @return Branch
     */
    public function setWidth(float $width): Branch {
        $this->width = $width;
        return $this;
    }

}