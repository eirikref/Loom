<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;
use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for making sure Settable::get() behaves correctly
 * when given keys and non-matching types.
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-09
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetInvalidTypeTest extends TestCase
{

    /**
     * Data provider with values and non-matching type descriptors
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
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
     * Test that get() handles non-string keys
     *
     * @test
     * @covers       \Loom\Settable::get
     * @dataProvider getValuesAndNonMatchingTypes
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-09
     * @access       public
     * @return       void
     *
     * @param        string $value The value
     * @param        string $type  The non-matching type
     */
    public function testNonMatchingValuesAndTypes($value, $type)
    {
        $store = new \Loom\Settable();
        $store->set("my.key", $value);
        $this->assertNull($store->get("my.key", $type));
    }
}
