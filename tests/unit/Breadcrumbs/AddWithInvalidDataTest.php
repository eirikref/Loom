<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2017 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Breadcrumbs;
use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for Breadcrumbs::add()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2017-04-09
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class AddWithInvalidDataTest extends TestCase
{

    /**
     * Data provider with various kinds of invalid data
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2017-04-09
     * @access public
     * @return array
     */
    public function getInvalidData()
    {
        return array(
            array(11),
            array(-3),
            array(3.14),
            array(true),
            array(""),
            array(false),
            array(array()),
            array(null),
            array(new \stdClass())
        );
    }



    /**
     * Test add() using invalid $url value
     *
     * @test
     * @dataProvider getInvalidData
     * @covers       \Loom\Breadcrumbs::add
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2017-04-09
     * @access       public
     * @return       void
     */
    public function testWithInvalidUrl($url)
    {
        $bc = new \Loom\Breadcrumbs();
        $this->assertFalse($bc->add($url, "test"));
        $this->assertEmpty($bc->get());
    }



    /**
     * Test add() using invalid $title value
     *
     * @test
     * @dataProvider getInvalidData
     * @covers       \Loom\Breadcrumbs::add
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2017-04-09
     * @access       public
     * @return       void
     */
    public function testWithInvalidTitle($title)
    {
        $bc = new \Loom\Breadcrumbs();
        $this->assertFalse($bc->add("/test", $title));
        $this->assertEmpty($bc->get());
    }



    /**
     * Test add() using too long parameters
     *
     * @test
     * @covers \Loom\Breadcrumbs::add
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2017-04-09
     * @access public
     * @return void
     */
    public function testWithTooLongParams()
    {
        $longUrl   = str_repeat("a", 4097);
        $longTitle = str_repeat("a", 101);

        $bc = new \Loom\Breadcrumbs();
        $this->assertFalse($bc->add($longUrl, "test"));
        $this->assertEmpty($bc->get());

        $bc = new \Loom\Breadcrumbs();
        $this->assertFalse($bc->add("/test", $longTitle));
        $this->assertEmpty($bc->get());
    }
}
