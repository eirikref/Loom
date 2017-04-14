<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2017 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Breadcrumbs;

/**
 * Loom: Unit tests for Breadcrumbs::add()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2017-04-09
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class SetSingleTest extends \PHPUnit_Framework_TestCase
{


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
    public function testParamsLengthLimit()
    {
        $short = "a";
        $url   = str_repeat("a", 4096);
        $title = str_repeat("a", 100);

        $bc = new \Loom\Breadcrumbs();
        $this->assertTrue($bc->add($short, "test"));

        $bc = new \Loom\Breadcrumbs();
        $this->assertTrue($bc->add($url, "test"));

        $bc = new \Loom\Breadcrumbs();
        $this->assertTrue($bc->add("/test", $short));

        $bc = new \Loom\Breadcrumbs();
        $this->assertTrue($bc->add("/test", $title));
    }
}
