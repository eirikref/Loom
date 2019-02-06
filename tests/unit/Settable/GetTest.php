<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for making sure Settable::get() behaves as
 * expected when setting valid data
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-09
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetTest extends TestCase
{

    /**
     * Test get() without any keys, which should end up returning the
     * entire data set.
     *
     * @test
     * @covers \Loom\Settable::get
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testGetWithNoKey()
    {
        $store = new \Loom\Settable();
        $this->assertEmpty($store->get());

        $store->set("a", "test");
        $store->set("b.c.d", "rest");
        $store->set("c.d", "best");
        $store->set("d.e.f.g", "pest");
        $store->set("e", "lest");
        $this->assertEquals(11, count($store->get(), COUNT_RECURSIVE));
    }



    /**
     * Data provider with all kinds of values.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
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
     * Test getting a single value using a simple key
     *
     * @test
     * @dataProvider getValues
     * @covers       \Loom\Settable::get
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-09
     * @access       public
     * @return       void
     */
    public function testSingleValue($value)
    {
        $key   = "mykey";
        $store = new \Loom\Settable();
        $store->set($key, $value);
        $this->assertEquals($value, $store->get($key));
    }



    /**
     * Test getting a single value using a valid key that does not
     * exist
     *
     * @test
     * @covers \Loom\Settable::get
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testSingleValueWithNonExistingKey()
    {
        $store = new \Loom\Settable();
        $store->set("a", "some value");
        $this->assertNull($store->get("b"));
    }



    /**
     * Test getting a single value using a multi-level key
     *
     * @test
     * @covers \Loom\Settable::get
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testSingleValueWithMultiLevelKey()
    {
        $key   = "a.b.c";
        $value = "some value";

        $store = new \Loom\Settable();
        $store->set($key, $value);
        $this->assertEquals($value, $store->get($key));
    }



    /**
     * Test getting a single value using a valid multi-level key that
     * does not exist
     *
     * @test
     * @covers \Loom\Settable::get
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testSingleValueWithNonExistingMultiLevelKey()
    {
        $store = new \Loom\Settable();
        $store->set("a.b.c", "some value");
        $this->assertNull($store->get("b.c.d"));
    }



    /**
     * Test getting values with matching types
     *
     * @test
     * @dataProvider getValues
     * @covers       \Loom\Settable::get
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-09
     * @access       public
     * @return       void
     */
    public function testValuesWithMatchingType($value, $type)
    {
        $key   = "mykey";
        $store = new \Loom\Settable();
        $store->set($key, $value);
        $this->assertEquals($value, $store->get($key, $type));
    }
}
