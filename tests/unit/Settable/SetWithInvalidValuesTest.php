<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

/**
 * Loom: Unit tests for making sure Settable::set() behaves correctly
 * with invalid input.
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2014-05-07
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class SetWithInvalidValuesTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider with invalid data
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-07
     * @access public
     * @return array
     */
    public function getInvalidValues()
    {
        return array(
            array(11,              'myvalue'),
            array(-3,              'myvalue'),
            array(3.14,            'myvalue'),
            array(true,            'myvalue'),
            array(false,           'myvalue'),
            array(null,            'myvalue'),
            array(array(),         'myvalue'),
            array(new \stdClass(), 'myvalue')
        );
    }



    /**
     * Test that set() with invalid values is handled as expected.
     *
     * @test
     * @dataProvider getInvalidValues
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-07
     * @access       public
     * @return       void
     *
     * @param        string $key   The variable name
     * @param        mixed  $value The value
     */
    public function testInvalidGetValues($key, $value)
    {
        $store = new \Loom\Settable();
        $this->assertNull($store->set($key, $value));
        $this->assertNull($store->get($key));
        // $this->assertEmpty($store->get());
    }



    /**
     * Test mismatch between type and actual value
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-07
     * @access public
     * @return void
     */
    public function testTypeMismatch()
    {
        $store = new \Loom\Settable();
        $this->assertNull($store->set('myKey', 'myValue', 'int'));

        $store->set('myKey', 'myValue', 'string');
        $this->assertNull($store->get('myKey', 'int'));
    }
}
