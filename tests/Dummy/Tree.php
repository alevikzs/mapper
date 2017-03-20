<?php

namespace Mapper\Tests\Dummy;

use \Mapper\Tests\Dummy\Tree as TreeAlias;

/**
 * Class Tree
 * @package Mapper\Tests\Dummy
 */
class Tree {

    /**
     * @var TreeAlias\Root
     */
    private $root;

    /**
     * @var TreeAlias\Trunk
     */
    private $trunk;

    /**
     * @var TreeAlias\Branch[]
     */
    private $branches;

    /**
     * @var Forest
     */
    private $forest;

    /**
     * @var float
     */
    private $height;

    /**
     * @var float
     */
    private $width;

    /**
     * @return TreeAlias\Root
     */
    public function getRoot(): TreeAlias\Root {
        return $this->root;
    }

    /**
     * @return Tree
     */
    public function setRoot(TreeAlias\Root $root): Tree {
        $this->root = $root;
        return $this;
    }

    /**
     * @return TreeAlias\Trunk
     */
    public function getTrunk(): TreeAlias\Trunk {
        return $this->trunk;
    }

    /**
     * @param TreeAlias\Trunk $trunk
     * @return Tree
     */
    public function setTrunk(TreeAlias\Trunk $trunk): Tree {
        $this->trunk = $trunk;
        return $this;
    }

    /**
     * @return TreeAlias\Branch[]
     */
    public function getBranches(): array {
        return $this->branches;
    }

    /**
     * @param TreeAlias\Branch[] $branches
     * @return Tree
     */
    public function setBranches(array $branches): Tree {
        $this->branches = $branches;
        return $this;
    }

    /**
     * @return Forest
     */
    public function getForest(): Forest {
        return $this->forest;
    }

    /**
     * @param Forest $forest
     * @return Tree
     */
    public function setForest(Forest $forest): Tree {
        $this->forest = $forest;
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
     * @return Tree
     */
    public function setHeight(float $height): Tree {
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
     * @return Tree
     */
    public function setWidth(float $width): Tree {
        $this->width = $width;
        return $this;
    }

}