<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

/**
 * Loom: Basic unit tests for Settable::set() and get()
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2014-05-07
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class BasicSetGetTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider for simple tests
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-06
     * @access public
     * @return array
     */
    public function getValidValues()
    {
        return array(
            array('mykey',   'myvalue'),
            array('one.two', 'someValue')
        );
    }



    /**
     * Test that setting and getting simple values work
     *
     * @test
     * @dataProvider getValidValues
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-06
     * @access       public
     * @return       void
     *
     * @param        string $key   The variable name
     * @param        mixed  $value The value
     */
    public function testGetValues($key, $value)
    {
        $store = new \Loom\Settable();
        $store->set($key, $value);
        $this->assertEquals($value, $store->get($key));
    }



    /**
     * Test that removing simple values work
     *
     * @test
     * @dataProvider getValidValues
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-07
     * @access       public
     * @return       void
     *
     * @param        string $key   The variable name
     * @param        mixed  $value The value
     */
    public function testBasicRemove($key, $value)
    {
        $store = new \Loom\Settable();
        $store->set($key, $value);
        $this->assertEquals($value, $store->get($key));
        $store->remove($key);
        $this->assertNull($store->get($key));
    }
}
