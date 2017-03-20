<?php

declare(strict_types = 1);

namespace Mapper\Tests;

use \PHPUnit\Framework\TestCase;

use \Mapper\ClassField;
use \Mapper\ClassFields;
use \Mapper\ClassParser;

/**
 * Class ClassParserTest
 * @package Mapper\Tests
 */
class ClassParserTest extends TestCase {

    public function testMain() {
        $classParser = new ClassParser('\Mapper\Tests\Dummy\Tree\Branch');
        $this->assertEquals('\Mapper\Tests\Dummy\Tree\Branch', $classParser->getClass());

        $classParser->setClass('\Mapper\Tests\Dummy\Tree');
        $this->assertEquals('\Mapper\Tests\Dummy\Tree', $classParser->getClass());

        $this->assertEquals(
            $classParser->getClassFields(),
            (new ClassFields())->add(new ClassField('setRoot', 'root', '\Mapper\Tests\Dummy\Tree\Root'))
                ->add(new ClassField('setTrunk', 'trunk', '\Mapper\Tests\Dummy\Tree\Trunk'))
                ->add((new ClassField('setBranches', 'branches', '\Mapper\Tests\Dummy\Tree\Branch'))->setIsSequential())
                ->add((new ClassField('setForest', 'forest', '\Mapper\Tests\Dummy\Forest')))
                ->add(new ClassField('setHeight', 'height', 'float'))
                ->add(new ClassField('setWidth', 'width', 'float'))
        );
    }

}