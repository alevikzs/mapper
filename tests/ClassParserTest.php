<?php

declare(strict_types = 1);

namespace Tests;

use \PHPUnit_Framework_TestCase as TestCase;

use \Mapper\ClassField;
use \Mapper\ClassFields;
use \Mapper\ClassParser;

use \Tests\Dummy\Tree;
use \Tests\Dummy\Branch;

/**
 * Class ClassParserTest
 * @package Tests
 */
class ClassParserTest extends TestCase {

    public function testMain() {
        $classParser = new ClassParser(Branch::class);
        $this->assertEquals(Branch::class, $classParser->getClass());

        $classParser->setClass(Tree::class);
        $this->assertEquals(Tree::class, $classParser->getClass());

        $this->assertEquals(
            $classParser->getClassFields(),
            (new ClassFields())->add(new ClassField('setHeight', 'height', 'float'))
                ->add(new ClassField('setName', 'name', 'string'))
                ->add(new ClassField('setBranch', 'branch', Branch::class))
        );
    }

}