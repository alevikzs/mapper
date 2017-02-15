<?php

declare(strict_types = 1);

namespace Tests;

use \PHPUnit_Framework_TestCase as TestCase;

use \Mapper\ClassField;
use \Mapper\ClassFields;

/**
 * Class ClassFieldsTest
 * @package Tests
 */
class ClassFieldsTest extends TestCase {

    public function testMain() {
        $setter = 'setBranch';
        $field = 'branch';

        $classField = new ClassField($setter, $field);
        $classFields = (new ClassFields())->add($classField);

        $wrongField = 'wrongField';

        $this->assertTrue($classFields->hasClassField($field));
        $this->assertFalse($classFields->hasClassField($wrongField));

        $this->assertEquals($classField, $classFields->getClassField($field));
        $this->assertNull($classFields->getClassField($wrongField));
    }

}