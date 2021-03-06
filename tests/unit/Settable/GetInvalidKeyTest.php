<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;
use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for making sure Settable::get() behaves correctly
 * when given invalid keys.
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-09
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetInvalidKeyTest extends TestCase
{

    /**
     * Data provider with non-strings, to be used for testing invalid
     * keys
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return array
     */
    public function getNonStrings()
    {
        return array(
            array(11),
            array(-3),
            array(3.14),
            array(true),
            array(false),
            array(array()),
            array(new \stdClass())
        );
    }



    /**
     * Test that get() handles non-string keys
     *
     * @test
     * @covers       \Loom\Settable::get
     * @dataProvider getNonStrings
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-09
     * @access       public
     * @return       void
     *
     * @param        string $key The key
     */
    public function testNonStrings($key)
    {
        $store = new \Loom\Settable();
        $this->assertNull($store->get($key));
    }



    /**
     * Test that empty string keys are not allowed
     *
     * @test
     * @covers \Loom\Settable::get
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testEmptyString()
    {
        $store = new \Loom\Settable();
        $this->assertNull($store->get(""));
    }



    /**
     * Test that too long string keys are not allowed
     *
     * @test
     * @covers \Loom\Settable::get
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testTooLongString()
    {
        $maxKeyLength = 128;
        $store        = new \Loom\Settable();

        $this->assertNull($store->get(str_repeat("a", $maxKeyLength + 1)));
    }
}
