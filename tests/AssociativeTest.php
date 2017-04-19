<?php

declare(strict_types = 1);

namespace Mapper\Tests;

use Mapper\Kind\Associative;

use \Mapper\Tests\Dummy\Tree;

/**
 * Class AssociativeTest
 * @package Mapper\Tests
 */
class AssociativeTest extends TestCase {

    /**
     * @return void
     */
    public function testMain() {
        $mapper = new Associative($this->getTreeArray(), new Tree());
        $this->assertEquals($this->getTreeObject(), $mapper->map());

        $mapper->setData($this->getBranchArray());
        $this->assertNotEquals($this->getBranchObject(), $mapper->map());

        $mapper->setObject(new Tree\Branch());
        $this->assertEquals($this->getBranchObject(), $mapper->map());

        $this->assertEquals($this->getBranchObject(), $mapper->getObject());
    }

}