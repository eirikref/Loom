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
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-10
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class CheckTypeInvalidTypeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider with non-strings, to be used for testing invalid
     * types
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-10
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
            array(null),
            array(array()),
            array(new \stdClass())
        );
    }



    /**
     * Test that checkType() handles non-string keys
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getNonStrings
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-10
     * @access       public
     * @return       void
     *
     * @param        string $type The type descriptor
     */
    public function testNonStrings($type)
    {
        $reflection = $this->getMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, "mykey", $type);
        $this->assertFalse($result);
    }



    /**
     * Test that empty string keys are not allowed
     *
     * @test
     * @covers \Loom\Settable::checkType
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-10
     * @access public
     * @return void
     */
    public function testEmptyString()
    {
        $reflection = $this->getMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, "mykey", "");
        $this->assertFalse($result);
    }



    /**
     * Test that too long string keys are not allowed
     *
     * @test
     * @covers \Loom\Settable::checkType
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-10
     * @access public
     * @return void
     */
    public function testTooLongString()
    {
        $maxKeyLength = 128;
        $arg          = str_repeat("a", $maxKeyLength + 1);
        $reflection   = $this->getMock("\Loom\Settable");
        $method       = new \ReflectionMethod($reflection, "checkType");

        $method->setAccessible(true);

        $result = $method->invoke($reflection, "mykey", "");
        $this->assertFalse($result);
    }
}
