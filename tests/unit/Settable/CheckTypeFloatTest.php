<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;
use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for making sure Settable::checkType() handle
 * floats correctly.
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-11
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class CheckTypeFloatTest extends TestCase
{

    /**
     * Data provider with non-floats, to be used for testing invalid
     * values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-11
     * @access public
     * @return array
     */
    public function getNonFloats()
    {
        return array(
            array(11),
            array(-3),
            array("some string"),
            array(true),
            array(false),
            array(null),
            array(array()),
            array(new \stdClass())
        );
    }



    /**
     * Test that checkType() does not allow non-float values as type
     * "float"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getNonFloats
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-11
     * @access       public
     * @return       void
     *
     * @param        mixed $value The value pretending to be a float
     */
    public function testNonFloats($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "float");
        $this->assertFalse($result);
    }



    /**
     * Data provider with floats, to be used for testing valid values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-11
     * @access public
     * @return array
     */
    public function getFloats()
    {
        return array(
            array(3.14),
            array(-3.14),
            array(123456789.0)
        );
    }



    /**
     * Test that checkType() allows float values as type "float"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getFloats
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-11
     * @access       public
     * @return       void
     *
     * @param        float $value The value pretending to be a float
     */
    public function testFloats($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "float");
        $this->assertTrue($result);
    }
}
