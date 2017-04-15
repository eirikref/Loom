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
 * @version    2014-05-11
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class CheckTypeBoolTest extends TestCase
{

    /**
     * Data provider with non-booleans, to be used for testing invalid
     * values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-11
     * @access public
     * @return array
     */
    public function getNonBooleans()
    {
        return array(
            array(11),
            array(-3),
            array(3.14),
            array("some string"),
            array(null),
            array(array()),
            array(new \stdClass())
        );
    }



    /**
     * Test that checkType() does not allow non-boolean values as type
     * "boolean"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getNonBooleans
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-11
     * @access       public
     * @return       void
     *
     * @param        mixed $value The value pretending to be a boolean
     */
    public function testNonBooleans($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "bool");
        $this->assertFalse($result);

        $result = $method->invoke($reflection, $value, "boolean");
        $this->assertFalse($result);
    }



    /**
     * Data provider with booleans, to be used for testing valid values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-11
     * @access public
     * @return array
     */
    public function getBooleans()
    {
        return array(
            array(true),
            array(false)
        );
    }



    /**
     * Test that checkType() allows booleans values as type "boolean"
     *
     * @test
     * @covers       \Loom\Settable::checkType
     * @dataProvider getBooleans
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-11
     * @access       public
     * @return       void
     *
     * @param        boolean $value The value pretending to be a boolean
     */
    public function testBooleans($value)
    {
        $reflection = $this->createMock("\Loom\Settable");
        $method = new \ReflectionMethod($reflection, "checkType");
        $method->setAccessible(true);
        
        $result = $method->invoke($reflection, $value, "bool");
        $this->assertTrue($result);

        $result = $method->invoke($reflection, $value, "boolean");
        $this->assertTrue($result);
    }
}
