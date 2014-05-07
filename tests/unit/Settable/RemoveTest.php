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
}
