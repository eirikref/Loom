<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;
use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for making sure Settable::checkType() handle
 * objects correctly.
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-11
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class CheckTypeObjectTest extends TestCase
{

    /**
     * Data provider with non-objects, to be used for testing invalid
     * values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-11
     * @access public
     * @return array
     */
    public function getNonObjects()
    {
        return array(
            array(11),
            array(-3),
            array(3.14),
            array(true),
            array(false),
            array(null),
            array(array()),
            array("some string")
        );
    }



    /**
     * Test that checkType() does not allow non-object values as type
     * "object"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getNonObjects
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-11
     * @access       public
     * @return       void
     *
     * @param        mixed $value The value pretending to be an object
     */
    public function testNonStrings($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "object");
        $this->assertFalse($result);
    }



    /**
     * Data provider with objects, to be used for testing valid values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-11
     * @access public
     * @return array
     */
    public function getObjects()
    {
        return array(
            array(new \StdClass())
        );
    }



    /**
     * Test that checkType() allows object values as type "object"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getObjects
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-11
     * @access       public
     * @return       void
     *
     * @param        object $value The value pretending to be an object
     */
    public function testStrings($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "object");
        $this->assertTrue($result);
    }
}
