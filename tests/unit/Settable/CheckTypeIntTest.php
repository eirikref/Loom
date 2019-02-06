<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for making sure Settable::checkType() handle
 * ints correctly.
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-11
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class CheckTypeIntTest extends TestCase
{

    /**
     * Data provider with non-ints, to be used for testing invalid
     * values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-11
     * @access public
     * @return array
     */
    public function getNonInts()
    {
        return array(
            array("some string"),
            array(3.14),
            array(true),
            array(false),
            array(null),
            array(array()),
            array(new \stdClass())
        );
    }



    /**
     * Test that checkType() does not allow non-int values as type "int"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getNonInts
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-11
     * @access       public
     * @return       void
     *
     * @param        mixed $value The value pretending to be a string
     */
    public function testNonInts($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "int");
        $this->assertFalse($result);
    }



    /**
     * Data provider with ints, to be used for testing valid values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-11
     * @access public
     * @return array
     */
    public function getInts()
    {
        return array(
            array(123),
            array(-123)
        );
    }



    /**
     * Test that checkType() allows int values as type "int"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getInts
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-11
     * @access       public
     * @return       void
     *
     * @param        int $value The value pretending to be a int
     */
    public function testStrings($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "int");
        $this->assertTrue($result);
    }
}
