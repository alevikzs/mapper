<?php

declare(strict_types = 1);

namespace Tests\Dummy;

use \JsonSerializable;

/**
 * Class Tree
 * @package Tests\Dummy
 */
class Tree implements JsonSerializable {

    /**
     * @var float
     */
    public $height;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Branch
     */
    private $branch;

    /**
     * @var Branch
     */
    private $something;

    /**
     * @return float
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * @param float $height
     * @return $this
     */
    public function setHeight($height) {
        $this->height = $height;

        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Branch
     */
    public function getBranch() {
        return $this->branch;
    }

    /**
     * @param Branch $branch
     * @return $this
     */
    public function setBranch(Branch $branch = null) {
        $this->branch = $branch;

        return $this;
    }

    /**
     * @param double $height
     * @param string $name
     * @param Branch $branch
     */
    public function __construct($height = null, $name = null, Branch $branch = null) {
        $this->height = $height;
        $this->name = $name;
        $this->branch = $branch;
        $this->something = 'something';
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return [
            'name' => $this->getName(),
            'height' => $this->getHeight(),
            'branch' => $this->getBranch()
        ];
    }

}