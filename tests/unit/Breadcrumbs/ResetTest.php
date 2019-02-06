<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2017 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Breadcrumbs;

use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for Breadcrumbs::reset()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2017-04-14
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ResetTest extends TestCase
{


    /**
     * Simple test for reset()
     *
     * @test
     * @covers \Loom\Breadcrumbs::reset
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2017-04-14
     * @access public
     * @return void
     */
    public function testBasicReset()
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

        $bc->reset();
        $this->assertEmpty($bc->get());
    }
}
