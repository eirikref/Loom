<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for making sure Settable::remove() behaves
 * correctly when given invalid keys.
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-09
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class RemoveInvalidKeyTest extends TestCase
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
     * Test that remove() handles non-string keys
     *
     * @test
     * @covers       \Loom\Settable::remove
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
        $this->assertNull($store->remove($key));
    }



    /**
     * Test that empty string keys are not allowed
     *
     * @test
     * @covers \Loom\Settable::remove
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testEmptyString()
    {
        $store = new \Loom\Settable();
        $this->assertNull($store->remove(""));
    }



    /**
     * Test that too long string keys are not allowed
     *
     * @test
     * @covers \Loom\Settable::remove
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-09
     * @access public
     * @return void
     */
    public function testTooLongString()
    {
        $maxKeyLength = 128;
        $store        = new \Loom\Settable();

        $this->assertNull($store->remove(str_repeat("a", $maxKeyLength + 1)));
    }
}
