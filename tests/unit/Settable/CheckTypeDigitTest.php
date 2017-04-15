<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;
use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for making sure Settable::checkType() handle
 * digits correctly.
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-11
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class CheckTypeDigitTest extends TestCase
{

    /**
     * Data provider with non-digits, to be used for testing invalid
     * values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-11
     * @access public
     * @return array
     */
    public function getNonDigits()
    {
        return array(
            array(-3),
            array(3.14),
            array(true),
            array(false),
            array(null),
            array("some string"),
            array(array()),
            array(new \stdClass())
        );
    }



    /**
     * Test that checkType() does not allow non-digit values as type "digit"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getNonDigits
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-11
     * @access       public
     * @return       void
     *
     * @param        mixed $value The value pretending to be a digit
     */
    public function testNonDigits($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "digit");
        $this->assertFalse($result);
    }



    /**
     * Data provider with digits, to be used for testing valid values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-11
     * @access public
     * @return array
     */
    public function getDigits()
    {
        return array(
            array("123"),
            array(123)
        );
    }



    /**
     * Test that checkType() allows digit values as type "digit"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getDigits
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-11
     * @access       public
     * @return       void
     *
     * @param        mixed $value The value pretending to be a digit
     */
    public function testDigits($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "digit");
        $this->assertTrue($result);
    }
}
