<?php

namespace Mapper\Tests\Dummy\Tree;

/**
 * Class Root
 * @package Mapper\Tests\Dummy\Tree
 */
class Root {

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
     * @return Root
     */
    public function setHeight(float $height): Root {
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
     * @return Root
     */
    public function setWidth(float $width): Root {
        $this->width = $width;
        return $this;
    }

}