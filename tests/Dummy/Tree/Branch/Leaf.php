<?php

namespace Mapper\Tests\Dummy\Tree\Branch;

use \JsonSerializable;

/**
 * Class Leaf
 * @package Mapper\Tests\Dummy\Tree\Branch
 */
class Leaf implements JsonSerializable {

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
     * @return Leaf
     */
    public function setHeight(float $height): Leaf {
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
     * @return Leaf
     */
    public function setWidth(float $width): Leaf {
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