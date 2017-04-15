<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2017 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Breadcrumbs;
use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for Breadcrumbs::set() and get()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2017-04-13
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class SetAndGetTest extends TestCase
{


    /**
     * Test simple set() and get()
     *
     * @test
     * @covers \Loom\Breadcrumbs::set
     * @covers \Loom\Breadcrumbs::get
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2017-04-13
     * @access public
     * @return void
     */
    public function testBasicSetAndGet()
    {
        $data = array(array("title" => "Test",
                            "url"   => "/test"));
        
        $bc = new \Loom\Breadcrumbs();
        $this->assertEmpty($bc->get());

        $bc->set($data);
        $this->assertCount(1, $bc->get());
    }



    /**
     * Test set() and get() with multiple items
     *
     * @test
     * @covers \Loom\Breadcrumbs::set
     * @covers \Loom\Breadcrumbs::get
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2017-04-14
     * @access public
     * @return void
     */
    public function testMultipleSetAndGet()
    {
        $data = array(array("title" => "A",
                            "url"   => "/a"),
                      array("title" => "B",
                            "url"   => "/a/b"),
                      array("title" => "C",
                            "url"   => "/a/b/c")
        );
        
        $bc = new \Loom\Breadcrumbs();
        $this->assertEmpty($bc->get());

        $bc->set($data);
        $this->assertCount(3, $bc->get());
    }
}
