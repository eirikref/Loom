<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for making sure Settable::checkType() handle
 * arrays correctly.
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-11
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class CheckTypeArrayTest extends TestCase
{

    /**
     * Data provider with non-arrays, to be used for testing invalid
     * values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-10
     * @access public
     * @return array
     */
    public function getNonArrays()
    {
        return array(
            array(11),
            array(-3),
            array(3.14),
            array(true),
            array(false),
            array(null),
            array("some string"),
            array(new \stdClass())
        );
    }



    /**
     * Test that checkType() does not allow non-array values as type "array"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getNonArrays
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-10
     * @access       public
     * @return       void
     *
     * @param        mixed $value The value pretending to be an array
     */
    public function testNonArrays($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "array");
        $this->assertFalse($result);
    }



    /**
     * Data provider with array, to be used for testing valid values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-10
     * @access public
     * @return array
     */
    public function getArrays()
    {
        return array(
            array(array()),
            array(array(1, 2, 3)),
            array(array("a" => 2, "b" => array("c")))
        );
    }



    /**
     * Test that checkType() allows array values as type "array"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getArrays
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-11
     * @access       public
     * @return       void
     *
     * @param        array $value The value pretending to be an array
     */
    public function testArrays($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "array");
        $this->assertTrue($result);
    }
}
