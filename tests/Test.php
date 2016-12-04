<?php

namespace Tests;

class Test extends \PHPUnit_Framework_TestCase {

    public function testMain() {
        $reflection = new \ReflectionClass('Mapper\Base');

        var_dump($reflection->getMethod('setSetter')->getDocComment());
    }

}