<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

/**
 * Loom: In-depth tests for removing keys
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2014-05-07
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class RemoveTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that remove() does not delete too much, ie. if you have
     * a.b.c and a.b.d and remove a.b.c, neither a nor a.b should be
     * removed.
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-07
     * @access public
     * @return void
     */
    public function testRemovePrecision()
    {
        // $expected = ['a' => ['b' => ['d' => 'some other value']]];

        $store = new \Loom\Settable();
        $store->set('a.b.c', 'some value');
        $store->set('a.b.d', 'some other value');
        $store->remove('a.b.c');

        $this->assertEquals('some other value', $store->get('a.b.d'));
        $this->assertNull($store->get('a.b.c'));
    }



    /**
     * Data provider with invalid data
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-07
     * @access public
     * @return array
     */
    public function getInvalidKeys()
    {
        return array(
            array(11),
            array(-3),
            array(3.14),
            array(true),
            array(false),
            array(null),
            array(array()),
            array(new \stdClass()),
            array(''),
            array(str_repeat('a', 129))
        );
    }



    /**
     * Test that invalid keys are rejected
     *
     * @test
     * @dataProvider getInvalidKeys
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-07
     * @access       public
     * @return       void
     */
    public function testRemoveRejectInvalidKeys($key)
    {
        $store = new \Loom\Settable();
        $store->set('test', 'some value');
        $this->assertNull($store->remove($key));
    }



    /**
     * Test that trying to remove on-existant keys are handled
     * correctly
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-08
     * @access public
     * @return void
     */
    public function testRemoveNonExistantKey()
    {
        $store = new \Loom\Settable();
        $store->set('test', 'some value');
        $this->assertNull($store->remove('somethingelse'));
    }
}
