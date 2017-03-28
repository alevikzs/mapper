<?php

declare(strict_types = 1);

namespace Mapper\Tests;

use Mapper\Kernel;
use \PHPUnit\Framework\TestCase;

use \Mapper\Tests\Dummy\Tree;
use \Mapper\Tests\Dummy\Forest;

/**
 * Class KernelTest
 * @package Mapper\Tests
 */
class KernelTest extends TestCase {

    /**
     * @var Tree
     */
    private $object;

    /**
     * @var array
     */
    private $array;

    /**
     * @return Tree
     */
    private function getObject() : Tree {
        if (is_null($this->object)) {
            $this->object = (new Tree())
                ->setRoot((new Tree\Root())->setHeight(1.1)->setWidth(3.2))
                ->setTrunk((new Tree\Trunk())->setHeight(0.2)->setWidth(4.3))
                ->setBranches([
                    (new Tree\Branch())->setFruits([
                        (new Tree\Branch\Fruit())->setHeight(3.1)->setWidth(2.2),
                        (new Tree\Branch\Fruit())->setHeight(4.1)->setWidth(1.2),
                    ])
                        ->setLeaves([
                            (new Tree\Branch\Leaf())->setHeight(1.6)->setWidth(5.6),
                            (new Tree\Branch\Leaf())->setHeight(1.7)->setWidth(5.7)
                        ])
                        ->setHeight(3.3)
                        ->setWidth(8.6),
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

        return $this->object;
    }

    /**
     * @return array
     */
    private function getArray(): array {
        if (is_null($this->array)) {
            $this->array = json_decode(json_encode($this->getObject()), true);
        }

        return $this->array;
    }

    public function testMain() {
        $kernel = new Kernel($this->getArray(), new Tree());

        $this->assertEquals($this->getObject(), $kernel->map());
    }

}