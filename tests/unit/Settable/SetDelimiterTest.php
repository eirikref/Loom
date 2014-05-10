<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

/**
 * Loom: Unit tests for making sure Settable::setDelimiter() behaves
 * as expected.
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-10
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class SetDelimiterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test to see if changing delimiter works as expected.
     *
     * @test
     * @covers \Loom\Settable::setDelimiter
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-10
     * @access public
     * @return void
     */
    public function testChangingDelimiter()
    {
        $key   = "a-b-c";
        $value = "some value";
        
        $store = new \Loom\Settable();
        $store->set($key, $value);
        $this->assertEquals(1, count($store->get(), COUNT_RECURSIVE));
        unset($store);

        $store = new \Loom\Settable();
        $store->setDelimiter("-");
        $store->set($key, $value);
        $this->assertEquals(3, count($store->get(), COUNT_RECURSIVE));
    }
}
