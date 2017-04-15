<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\File;
use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for File::__construct()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-06-26
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class FromPathTest extends TestCase
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
     * @covers       \Loom\File::fromPath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-14
     * @access       public
     * @return       void
     */
    public function testFromPathWithInvalidPaths($path)
    {
        $file = \Loom\File::fromPath($path);
        $this->assertNull($file);
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
     * @covers       \Loom\File::fromPath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-26
     * @access       public
     * @return       void
     */
    public function testFromPathWithValidPaths($path)
    {
        $file = \Loom\File::fromPath($path);
        $this->assertTrue(is_string($file->getPath()));
    }
}
