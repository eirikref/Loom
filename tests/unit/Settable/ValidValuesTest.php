<?php

class ValidValuesTest extends PHPUnit_Framework_TestCase
{
    
    public function getValidValues()
    {
        $gen = new \Fiber\String();
        return $gen->get();
    }


    /**
     * @dataProvider getValidValues
     */
    public function testSetValues($key, $value)
    {
        $store = new \Loom\Settable();
        $this->assertTrue($store->set($key, $value));
    }



    /**
     * @dataProvider getValidValues
     */
    public function testGetValues($key, $value)
    {
        $store = new \Loom\Settable();
        $store->set($key, $value);
        $this->assertEquals($value, $store->get($key));
    }

}