<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

use PHPUnit\Framework\TestCase;

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
 * @version    2014-05-09
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class SetTest extends TestCase
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



    /**
     * Test replacing a simple key value
     *
     * @test
     * @covers \Loom\Settable::set
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-08
     * @access public
     * @return void
     */
    public function testReplacingSimpleKeyValue()
    {
        $key         = "mykey";
        $firstValue  = "some value";
        $secondValue = 11;
        $store       = new \Loom\Settable();

        $store->set($key, $firstValue);
        $this->assertEquals($firstValue, $store->get($key));
        $this->assertEquals(1, count($store->get()));

        $store->set($key, $secondValue);
        $this->assertEquals($secondValue, $store->get($key));
        $this->assertEquals(1, count($store->get()));
    }



    /**
     * Test replacing a multi-key value
     *
     * @test
     * @covers \Loom\Settable::set
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-08
     * @access public
     * @return void
     */
    public function testReplacingMultiKeyValue()
    {
        $key         = "a.b.c";
        $firstValue  = "some value";
        $secondValue = 11;
        $store       = new \Loom\Settable();

        $store->set($key, $firstValue);
        $this->assertEquals($firstValue, $store->get($key));
        $this->assertEquals(1, count($store->get()));

        $store->set($key, $secondValue);
        $this->assertEquals($secondValue, $store->get($key));
        $this->assertEquals(3, count($store->get(), COUNT_RECURSIVE));
    }



    /**
     * Test setting subvalues below already existing values
     *
     * @test
     * @covers \Loom\Settable::set
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-08
     * @access public
     * @return void
     */
    public function testAddingSubValues()
    {
        $levelOneKey    = "a.b.c";
        $levelOneValue  = "some value";
        $levelTwoKey    = "a.b.c.d.e";
        $levelTwoValue  = "something else";
        $store          = new \Loom\Settable();
        
        $store->set($levelOneKey, $levelOneValue);
        $store->set($levelTwoKey, $levelTwoValue);

        $this->assertNotEquals($levelOneValue, $store->get($levelOneKey));
        $this->assertEquals($levelTwoValue, $store->get($levelTwoKey));
    }



    /**
     * Test setting a value for a key that already exists with sub
     * values
     *
     * @test
     * @covers \Loom\Settable::set
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testAddingValueWhenSubValuesExist()
    {
        $levelOneKey    = "a.b.c.d.e";
        $levelOneValue  = "some value";
        $levelTwoKey    = "a.b.c";
        $levelTwoValue  = "something else";
        $store          = new \Loom\Settable();
        
        $store->set($levelOneKey, $levelOneValue);
        $store->set($levelTwoKey, $levelTwoValue);

        $this->assertNotEquals($levelOneValue, $store->get($levelOneKey));
        $this->assertEquals($levelTwoValue, $store->get($levelTwoKey));
        $this->assertEquals(3, count($store->get(), COUNT_RECURSIVE));
    }



    /**
     * Test setting multiple values on the same sub level
     *
     * @test
     * @covers \Loom\Settable::set
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-08
     * @access public
     * @return void
     */
    public function testAddingMultipleValuesOnSameSubLevel()
    {
        $levelOneKey    = "a.b.c";
        $levelOneValue  = "some value";
        $levelTwoKey    = "a.b.d";
        $levelTwoValue  = "something else";
        $store          = new \Loom\Settable();
        
        $store->set($levelOneKey, $levelOneValue);
        $store->set($levelTwoKey, $levelTwoValue);

        $this->assertEquals($levelOneValue, $store->get($levelOneKey));
        $this->assertEquals($levelTwoValue, $store->get($levelTwoKey));
        $this->assertEquals(4, count($store->get(), COUNT_RECURSIVE));
    }
}
