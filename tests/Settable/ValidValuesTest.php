<?php

class ValidValuesTest extends PHPUnit_Framework_TestCase
{

    public function testValues()
    {
        $store = new \Loom\Settable();
        $this->assertTrue($store->set("test", "someValue"));
    }

}