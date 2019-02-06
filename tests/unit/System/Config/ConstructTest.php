<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\System\Config;

use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for the Config constructor
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-07-01
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ConstructTest extends TestCase
{

    /**
     * Simple constructor test without any arguments
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-11
     * @access public
     * @return void
     */
    public function testConstructorWithoutArguments()
    {
        $config = new \Loom\System\Config();
        $this->assertEquals(0, count($config->get()));
    }



    /**
     * Simple constructor test with empty array as argument
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-01
     * @access public
     * @return void
     */
    public function testConstructorWithEmptyArray()
    {
        $arg    = array();
        $config = new \Loom\System\Config($arg);
        $this->assertEquals(0, count($config->get()));
    }



    /**
     * Simple constructor test with non-empty array as argument
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-01
     * @access public
     * @return void
     */
    public function testConstructorWithnNonEmptyArray()
    {
        $arg    = array("a"     => "value",
                        "b"     => "some other value",
                        "b.c.d" => "yet another value");

        $config = new \Loom\System\Config($arg);
        $this->assertEquals(3, count($config->get()));
    }
}
