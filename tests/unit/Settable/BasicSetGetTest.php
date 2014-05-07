<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
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

    public function getValidValues()
    {
        return array(
            array('mykey',   'myvalue'),
            array('one.two', 'someValue')
        );
    }


    /**
     * @test
     * @dataProvider getValidValues
     */
    public function testGetValues($key, $value)
    {
        $store = new \Loom\Settable();
        $store->set($key, $value);
        $this->assertEquals($value, $store->get($key));
    }
}
