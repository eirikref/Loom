<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

/**
 * Loom: Unit tests for the Config constructor
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-11
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ConstructTest extends \PHPUnit_Framework_TestCase
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
        $config = new \Loom\Config();
        $this->assertEquals(0, count($config->get()));
    }
}
