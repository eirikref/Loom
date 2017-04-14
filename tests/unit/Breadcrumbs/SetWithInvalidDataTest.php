<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2017 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Breadcrumbs;

/**
 * Loom: Unit tests for Breadcrumbs::set() with invalid data
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2017-04-14
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class SetWithInvalidDataTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider with various invalid data, but wrapped inside an
     * array in order to pass the function declaration
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2017-04-14
     * @access public
     * @return array
     */
    public function getInvalidData()
    {
        return array(
            array(array(array())),
            array(array(array("a", "b"))),
            array(array(array("url" => "/a", "b"))),
            array(array(array("a" => "/a", "title" => "B"))),
            array(array(array("url" => "", "title" => "B")))
        );
    }



    /**
     * Test set() with invalid array data
     *
     * @test
     * @dataProvider getInvalidData
     * @covers       \Loom\Breadcrumbs::set
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2017-04-14
     * @access       public
     * @return       void
     */
    public function testWithInvalidData($data)
    {
        $bc = new \Loom\Breadcrumbs();
        $this->assertEmpty($bc->get());

        $bc->set($data);
        $this->assertEmpty($bc->get());
    }

    

    // /**
    //  * Data provider with various kinds of invalid data
    //  *
    //  * @author Eirik Refsdal <eirikref@gmail.com>
    //  * @since  2017-04-14
    //  * @access public
    //  * @return array
    //  */
    // public function getInvalidTypes()
    // {
    //     return array(
    //         array(11),
    //         array(-3),
    //         array(3.14),
    //         array(true),
    //         array(""),
    //         array(false),
    //         array(null),
    //         array(new \stdClass())
    //     );
    // }



    // /**
    //  * Test set() with invalid types
    //  *
    //  * @test
    //  * @dataProvider      getInvalidTypes
    //  * @expectedException PHPUnit_Framework_Error
    //  * @covers            \Loom\Breadcrumbs::set
    //  * @author            Eirik Refsdal <eirikref@gmail.com>
    //  * @since             2017-04-14
    //  * @access            public
    //  * @return            void
    //  */
    // public function testWithInvalidTypes($data)
    // {
    //     $bc = new \Loom\Breadcrumbs();
    //     $this->assertEmpty($bc->get());

    //     $bc->set($data);
    //     $this->assertEmpty($bc->get());
    // }
}
