<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

/**
 * Loom: Unit tests for making sure Settable::set() behaves correctly
 * when given invalid keys.
 *
 * @package    Fiber
 * @subpackage Tests
 * @version    2014-05-08
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class SetInvalidTypeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider with values and non-matching type descriptors
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-08
     * @access public
     * @return array
     */
    public function getValuesAndNonMatchingTypes()
    {
        return array(
            array(11, "string"),
            array(-3, "bool"),
            array(3.14, "string"),
            array(true, "int"),
            array(false, "digit"),
            array(null, "string"),
            array(array(), "digit"),
            array(new \stdClass(), "string")
        );
    }



    /**
     * Test that set() handles non-string keys
     *
     * @test
     * @covers       \Loom\Settable::set
     * @dataProvider getValuesAndNonMatchingTypes
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-08
     * @access       public
     * @return       void
     *
     * @param        string $value The value
     * @param        string $type  The non-matching type
     */
    public function testNonMatchingValuesAndTypes($value, $type)
    {
        $store = new \Loom\Settable();
        $this->assertNull($store->set("my.key", $value, $type));
        $this->assertEmpty($store->get());
    }
}
