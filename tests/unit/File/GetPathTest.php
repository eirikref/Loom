<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Settable;

/**
 * Loom: Unit tests for File::getPath()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-26
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetPathTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider with all kinds of invalid paths
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-26
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
     * Test getPath() when invalid paths have been set
     *
     * @test
     * @dataProvider getInvalidPaths
     * @covers       \Loom\File::getPath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-26
     * @access       public
     * @return       void
     */
    public function testWithInvalidPaths($path)
    {
        $file = new \Loom\File($path);
        $this->assertNull($file->getPath($path));
    }



    /**
     * Data provider with all kinds of valid paths
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-26
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
     * Test getPath() using valid path value
     *
     * @test
     * @dataProvider getValidPaths
     * @covers       \Loom\File::getPath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-26
     * @access       public
     * @return       void
     */
    public function testWithValidPaths($path)
    {
        $file = new \Loom\File($path);
        $this->assertEquals($path, $file->getPath());
    }
}
