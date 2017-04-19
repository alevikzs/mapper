<?php

declare(strict_types = 1);

namespace Mapper\Tests;

use \Mapper\Kind\Json;

use \Mapper\Tests\Dummy\Tree;

/**
 * Class JsonTest
 * @package Mapper\Tests
 */
class JsonTest extends TestCase {

    /**
     * @return void
     */
    public function testMain() {
        $mapper = new Json($this->getTreeJson(), new Tree());
        $this->assertEquals($this->getTreeObject(), $mapper->map());

        $mapper->setData($this->getBranchJson());
        $this->assertNotEquals($this->getBranchObject(), $mapper->map());

        $mapper->setObject(new Tree\Branch());
        $this->assertEquals($this->getBranchObject(), $mapper->map());

        $this->assertEquals($this->getBranchObject(), $mapper->getObject());
    }

    /**
     * @return void
     */
    public function testInvalidObjectPassed() {
        $mapper = new Json($this->getTreeJson(), new Tree());

        $this->expectException('Exception');
        $this->expectExceptionMessage('Invalid object passed');
        $mapper->setObject(null);
    }

    /**
     * @return void
     */
    public function testInvalidJsonPassed() {
        $mapper = new Json($this->getTreeJson(), new Tree());

        $this->expectException('Exception');
        $this->expectExceptionMessage('Invalid json passed');
        $mapper->setData('invalid json');
    }

}