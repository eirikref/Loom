<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\File;

/**
 * Loom: Unit tests for File::__construct()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-26
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ConstructorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider with all kinds of invalid paths
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-14
     * @access public
     * @return array
     */
    public function getInvalidPaths()
    {
        return array(
            array(11),
            array(-3),
            array(3.14),
            array(true),
            array(false),
            array(array()),
            array(null),
            array(new \stdClass())
        );
    }



    /**
     * Test the constructor using invalid path value
     *
     * @test
     * @dataProvider getInvalidPaths
     * @covers       \Loom\File::__construct
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-14
     * @access       public
     * @return       void
     */
    public function testConstructorWithInvalidPaths($path)
    {
        $file = new \Loom\File($path);
        $this->assertNull($file->getPath());
    }



    /**
     * Data provider with all kinds of valid paths
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-14
     * @access public
     * @return array
     */
    public function getValidPaths()
    {
        return array(
            array("/some/path"),
            array("/usr/local/something"),
            array("/anything"),
        );
    }



    /**
     * Test the constructor using valid path value
     *
     * @test
     * @dataProvider getValidPaths
     * @covers       \Loom\File::__construct
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-26
     * @access       public
     * @return       void
     */
    public function testConstructorWithValidPaths($path)
    {
        $file = new \Loom\File($path);
        $this->assertTrue(is_string($file->getPath()));
    }
}
