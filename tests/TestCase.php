<?php

declare(strict_types = 1);

namespace Mapper\Tests;

use \PHPUnit\Framework\TestCase as BaseTestCase;

use \Mapper\Tests\Dummy\Tree;
use \Mapper\Tests\Dummy\Forest;

/**
 * Class TestCase
 * @package Mapper\Tests
 */
abstract class TestCase extends BaseTestCase {

    /**
     * @var Tree
     */
    private $treeObject;

    /**
     * @var array
     */
    private $treeArray;

    /**
     * @var string
     */
    private $treeJson;

    /**
     * @var Tree\Branch
     */
    private $branchObject;

    /**
     * @var array
     */
    private $branchArray;

    /**
     * @var string
     */
    private $branchJson;

    /**
     * @return Tree
     */
    protected function getTreeObject(): Tree {
        if (is_null($this->treeObject)) {
            $this->treeObject = (new Tree())
                ->setRoot((new Tree\Root())->setHeight(1.1)->setWidth(3.2))
                ->setTrunk((new Tree\Trunk())->setHeight(0.2)->setWidth(4.3))
                ->setBranches([
                    $this->getBranchObject(),
                    (new Tree\Branch())->setFruits([
                        (new Tree\Branch\Fruit())->setHeight(2.1)->setWidth(3.2),
                        (new Tree\Branch\Fruit())->setHeight(7.1)->setWidth(5.2),
                    ])
                        ->setLeaves([
                            (new Tree\Branch\Leaf())->setHeight(2.6)->setWidth(2.6),
                            (new Tree\Branch\Leaf())->setHeight(2.7)->setWidth(2.7)
                        ])
                        ->setHeight(2.3)
                        ->setWidth(2.6)
                ])
                ->setForest(new Forest())
                ->setHeight(4)
                ->setWidth(9);
        }

        return $this->treeObject;
    }

    /**
     * @return array
     */
    protected function getTreeArray(): array {
        if (is_null($this->treeArray)) {
            $this->treeArray = json_decode(json_encode($this->getTreeObject()), true);
        }

        return $this->treeArray;
    }

    /**
     * @return string
     */
    protected function getTreeJson(): string {
        if (is_null($this->treeJson)) {
            $this->treeJson = json_encode($this->getTreeObject());
        }

        return $this->treeJson;
    }

    /**
     * @return Tree\Branch
     */
    protected function getBranchObject(): Tree\Branch {
        if (is_null($this->branchObject)) {
            $this->branchObject = (new Tree\Branch())->setFruits([
                (new Tree\Branch\Fruit())->setHeight(3.1)->setWidth(2.2),
                (new Tree\Branch\Fruit())->setHeight(4.1)->setWidth(1.2),
            ])->setLeaves([
                (new Tree\Branch\Leaf())->setHeight(1.6)->setWidth(5.6),
                (new Tree\Branch\Leaf())->setHeight(1.7)->setWidth(5.7)
            ])
            ->setHeight(3.3)
            ->setWidth(8.6);
        }

        return $this->branchObject;
    }

    /**
     * @return array
     */
    protected function getBranchArray(): array {
        if (is_null($this->branchArray)) {
            $this->branchArray = json_decode(json_encode($this->getBranchObject()), true);
        }

        return $this->branchArray;
    }

    /**
     * @return string
     */
    protected function getBranchJson(): string {
        if (is_null($this->branchJson)) {
            $this->branchJson = json_encode($this->getBranchObject());
        }

        return $this->branchJson;
    }

}