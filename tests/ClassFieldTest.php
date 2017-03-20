<?php

declare(strict_types = 1);

namespace Mapper\Tests;

use \PHPUnit\Framework\TestCase;

use \Mapper\ClassField;

/**
 * Class ClassFieldTest
 * @package Mapper\Tests
 */
class ClassFieldTest extends TestCase {

    public function testClass() {
        $setter = 'setBranch';
        $name = 'branch';
        $type = 'Mapper\Tests\Dummy\Tree\Branch';

        $classField = new ClassField($setter, $name, $type);

        $this->assertEquals($classField->getSetter(), $setter);
        $this->assertEquals($classField->getName(), $name);
        $this->assertEquals($classField->getType(), "\\$type");

        $this->assertFalse($classField->isAssociative());
        $this->assertTrue($classField->isNotAssociative());

        $this->assertFalse($classField->isSequential());
        $this->assertTrue($classField->isNotSequential());

        $this->assertTrue($classField->isClass());
        $this->assertFalse($classField->isNotClass());

        $this->assertFalse($classField->isSimple());
        $this->assertTrue($classField->isNotSimple());
    }

    public function testSimple() {
        $setter = 'setLength';
        $name = 'length';
        $type = 'double';

        $classField = new ClassField($setter, $name, $type);

        $this->assertEquals($classField->getSetter(), $setter);
        $this->assertEquals($classField->getName(), $name);
        $this->assertEquals($classField->getType(), $type);

        $this->assertFalse($classField->isAssociative());
        $this->assertTrue($classField->isNotAssociative());

        $this->assertFalse($classField->isSequential());
        $this->assertTrue($classField->isNotSequential());

        $this->assertFalse($classField->isClass());
        $this->assertTrue($classField->isNotClass());

        $this->assertTrue($classField->isSimple());
        $this->assertFalse($classField->isNotSimple());
    }

    public function testAssociative() {
        $setter = 'setLeaves';
        $name = 'leaves';
        $type = 'array';

        $classField = new ClassField($setter, $name, $type);

        $this->assertEquals($classField->getSetter(), $setter);
        $this->assertEquals($classField->getName(), $name);
        $this->assertEquals($classField->getType(), $type);

        $this->assertTrue($classField->isAssociative());
        $this->assertFalse($classField->isNotAssociative());

        $this->assertFalse($classField->isSequential());
        $this->assertTrue($classField->isNotSequential());

        $this->assertFalse($classField->isClass());
        $this->assertTrue($classField->isNotClass());

        $this->assertFalse($classField->isSimple());
        $this->assertTrue($classField->isNotSimple());
    }

    public function testEmptyType() {
        $setter = 'setEmpty';
        $name = 'empty';

        $classField = new ClassField($setter, $name);

        $this->assertEquals($classField->getSetter(), $setter);
        $this->assertEquals($classField->getName(), $name);
        $this->assertEmpty($classField->getType());

        $this->assertFalse($classField->isAssociative());
        $this->assertTrue($classField->isNotAssociative());

        $this->assertFalse($classField->isSequential());
        $this->assertTrue($classField->isNotSequential());

        $this->assertFalse($classField->isClass());
        $this->assertTrue($classField->isNotClass());

        $this->assertFalse($classField->isSimple());
        $this->assertTrue($classField->isNotSimple());
    }

    public function testSetters() {
        $setter = 'setLength';
        $name = 'length';

        $classField = new ClassField($setter, $name);

        $newSetter = 'setLeaves';
        $newName = 'leaves';
        $newType = '\Mapper\Tests\Dummy\Tree\Branch\Leaf';

        $classField->setType($newType)
            ->setSetter($newSetter)
            ->setName($newName)
            ->setIsSequential();

        $this->assertEquals($classField->getSetter(), $newSetter);
        $this->assertEquals($classField->getName(), $newName);
        $this->assertEquals($classField->getType(), $newType);

        $this->assertTrue($classField->isSequential());
        $this->assertFalse($classField->isNotSequential());

        $this->assertTrue($classField->isClass());
        $this->assertFalse($classField->isNotClass());

        $classField->setIsAssociative()
            ->setIsSimple();

        $this->assertTrue($classField->isAssociative());
        $this->assertFalse($classField->isNotAssociative());

        $this->assertTrue($classField->isSimple());
        $this->assertFalse($classField->isNotSimple());

        $classField->setIsNotAssociative()
            ->setIsNotSimple()
            ->setIsNotSequential()
            ->setIsNotClass();

        $this->assertFalse($classField->isAssociative());
        $this->assertTrue($classField->isNotAssociative());

        $this->assertFalse($classField->isSequential());
        $this->assertTrue($classField->isNotSequential());

        $this->assertFalse($classField->isClass());
        $this->assertTrue($classField->isNotClass());

        $this->assertFalse($classField->isSimple());
        $this->assertTrue($classField->isNotSimple());
    }

}