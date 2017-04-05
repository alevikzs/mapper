<?php

declare(strict_types = 1);

namespace Mapper\Tests;

use \Mapper\Kernel;

use \Mapper\Tests\Dummy\Tree;

/**
 * Class KernelTest
 * @package Mapper\Tests
 */
class KernelTest extends TestCase {

    /**
     * @return void
     */
    public function testMain() {
        $kernel = new Kernel($this->getTreeArray(), new Tree());
        $this->assertEquals($this->getTreeObject(), $kernel->map());

        $kernel->setData($this->getBranchArray());
        $this->assertNotEquals($this->getBranchObject(), $kernel->map());

        $kernel->setObject(new Tree\Branch());
        $this->assertEquals($this->getBranchObject(), $kernel->map());
    }

}