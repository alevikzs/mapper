<?php

namespace Mapper\Tests\Dummy\Tree\Branch;

use \JsonSerializable;

/**
 * Class Fruit
 * @package Mapper\Tests\Dummy\Tree\Branch
 */
class Fruit implements JsonSerializable {

    /**
     * @var float
     */
    private $height;

    /**
     * @var float
     */
    private $width;

    /**
     * @return float
     */
    public function getHeight(): float {
        return $this->height;
    }

    /**
     * @param float $height
     * @return Fruit
     */
    public function setHeight(float $height): Fruit {
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
     * @return Fruit
     */
    public function setWidth(float $width): Fruit {
        $this->width = $width;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array {
        return get_object_vars($this);
    }

}