<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

/**
 * Loom: Unit tests for making sure Settable::remove() behaves as
 * expected.
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-09
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class RemoveTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test removing something that does not exist, even though the
     * key itself is valid and nice.
     *
     * @test
     * @covers \Loom\Settable::remove
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testRemovingNonExistantKey()
    {
        $store = new \Loom\Settable();
        $this->assertNull($store->remove("a.b.c"));
    }



    /**
     * Test removing a value with using a single level key.
     *
     * @test
     * @covers \Loom\Settable::remove
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testRemovingUsingSingleLevelKey()
    {
        $store = new \Loom\Settable();

        $store->set("mykey", "something");
        $this->assertEquals(1, count($store->get(), COUNT_RECURSIVE));
        $this->assertTrue($store->remove("mykey"));
        $this->assertEmpty($store->get());
    }



    /**
     * Test removing a value with using a multi level key.
     *
     * @test
     * @covers \Loom\Settable::remove
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testRemovingUsingMultiLevelKey()
    {
        $store = new \Loom\Settable();

        $store->set("a.b.c", "something");
        $this->assertEquals(3, count($store->get(), COUNT_RECURSIVE));
        $this->assertTrue($store->remove("a.b.c"));
        $this->assertEmpty($store->get());
    }



    /**
     * Test removing a value with using a multi level key, while
     * leaving other values in the same namespace alone.
     *
     * @test
     * @covers \Loom\Settable::remove
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testRemovingUsingMultiLevelKeyWithNamespace()
    {
        $store = new \Loom\Settable();

        $store->set("a.b.c", "something");
        $store->set("a.b.d", "something else");
        $this->assertEquals(4, count($store->get(), COUNT_RECURSIVE));
        $this->assertTrue($store->remove("a.b.d"));
        $this->assertEquals(3, count($store->get(), COUNT_RECURSIVE));
    }



    /**
     * Test setting a.b.c, and then removing just a
     *
     * @test
     * @covers \Loom\Settable::remove
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testRemovingParentKey()
    {
        $store = new \Loom\Settable();

        $store->set("a.b.c", "something");
        $this->assertEquals(3, count($store->get(), COUNT_RECURSIVE));
        $this->assertTrue($store->remove("a"));
        $this->assertEmpty($store->get());
    }
}
