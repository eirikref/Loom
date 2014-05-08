<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

/**
 * Loom: Unit tests for making sure Settable::set() behaves as
 * expected when setting valid data
 *
 * - Simple key, with value
 * - Multi-level key, with value
 * - Both of the above, with a given type
 * - Multiple keys, different namespace
 * - Multiple keys, same namespace
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-08
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class SetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider with all kinds of values.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-08
     * @access public
     * @return array
     */
    public function getValues()
    {
        return array(
            array(11, "int"),
            array(11, "digit"),
            array(-3, "int"),
            array(3.14, "float"),
            array(true, "bool"),
            array(true, "boolean"),
            array(false, "bool"),
            array(false, "boolean"),
            array(array(), "array"),
            array(new \stdClass(), "object")
        );
    }



    /**
     * Test setting a single value using a simple key
     *
     * @test
     * @dataProvider getValues
     * @covers       \Loom\Settable::set
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-08
     * @access       public
     * @return       void
     */
    public function testSingleValue($value)
    {
        $key   = "mykey";
        $store = new \Loom\Settable();
        $this->assertTrue($store->set($key, $value));
        $this->assertEquals($value, $store->get($key));
        $this->assertEquals(1, count($store->get()));
    }



    /**
     * Test setting a single value using a simple key and the
     * corresponding type
     *
     * @test
     * @dataProvider getValues
     * @covers       \Loom\Settable::set
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-08
     * @access       public
     * @return       void
     */
    public function testSingleValueWithType($value, $type)
    {
        $key   = "mykey";
        $store = new \Loom\Settable();
        $this->assertTrue($store->set($key, $value, $type));
        $this->assertEquals($value, $store->get($key));
        $this->assertEquals(1, count($store->get()));
    }



    /**
     * Test setting a single value using a multi-level key
     *
     * @test
     * @dataProvider getValues
     * @covers       \Loom\Settable::set
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-08
     * @access       public
     * @return       void
     */
    public function testSingleValueWithMultiLevelKey($value)
    {
        $key   = "a.b.c";
        $store = new \Loom\Settable();
        $this->assertTrue($store->set($key, $value));
        $this->assertEquals($value, $store->get($key));
        $this->assertEquals(1, count($store->get()));
    }



    /**
     * Test setting a single value using multi-level key and the
     * corresponding type
     *
     * @test
     * @dataProvider getValues
     * @covers       \Loom\Settable::set
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-08
     * @access       public
     * @return       void
     */
    public function testSingleValueWithTypeAndMultiLevelKey($value, $type)
    {
        $key   = "a.b.c";
        $store = new \Loom\Settable();
        $this->assertTrue($store->set($key, $value, $type));
        $this->assertEquals($value, $store->get($key));
        $this->assertEquals(1, count($store->get()));
    }
}
