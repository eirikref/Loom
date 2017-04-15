<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;
use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for making sure Settable::checkType() handle
 * strings correctly.
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-10
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class CheckTypeStringTest extends TestCase
{

    /**
     * Data provider with non-strings, to be used for testing invalid
     * values
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
     * Test that checkType() does not allow non-string values as type
     * "string"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getNonStrings
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-10
     * @access       public
     * @return       void
     *
     * @param        string $value The value pretending to be a string
     */
    public function testNonStrings($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "string");
        $this->assertFalse($result);
    }



    /**
     * Data provider with strings, to be used for testing valid values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-10
     * @access public
     * @return array
     */
    public function getStrings()
    {
        return array(
            array("a"),
            array(""),
            array(str_repeat("a", 1024))
        );
    }



    /**
     * Test that checkType() allows string values as type "string"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getStrings
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-10
     * @access       public
     * @return       void
     *
     * @param        mixed $value The value pretending to be a string
     */
    public function testStrings($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "string");
        $this->assertTrue($result);
    }
}
