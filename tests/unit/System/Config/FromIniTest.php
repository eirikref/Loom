<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Config;

/**
 * Loom: Unit tests for Config::fromIni()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-07-02
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class FromIniTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider with all kinds of invalid paths
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-01
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
            array(new \stdClass()),
            array("")
        );
    }



    /**
     * Test fromIni() using invalid path value
     *
     * @test
     * @dataProvider getInvalidPaths
     * @covers       \Loom\Config::fromIni
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-07-01
     * @access       public
     * @return       void
     */
    public function testWithInvalidPaths($path)
    {
        $this->assertNull(\Loom\System\Config::fromIni($path));
    }



    /**
     * Data provider with all kinds of valid, but non-existent, paths
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-01
     * @access public
     * @return array
     */
    public function getValidButNonExistentPaths()
    {
        return array(
            array("/some/path"),
            array("/usr/local/something"),
            array("/anything"),
            array("file.txt"),
        );
    }



    /**
     * Test fromIni() using valid, but non-existent, paths
     *
     * @test
     * @dataProvider getValidButNonExistentPaths
     * @covers       \Loom\Config::fromIni
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-07-01
     * @access       public
     * @return       void
     */
    public function testWithValidButNonExistentPaths($path)
    {
        $this->assertNull(\Loom\System\Config::fromIni($path));
    }



    /**
     * Data provider with valid paths that do exist
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-01
     * @access public
     * @return array
     */
    public function getValidPaths()
    {
        return array(
            array("tests/unit/System/Config/data/simple.ini"),
        );
    }



    /**
     * Test fromIni() using valid paths
     *
     * @test
     * @dataProvider getValidPaths
     * @covers       \Loom\Config::fromIni
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-07-01
     * @access       public
     * @return       void
     */
    public function testWithValidPaths($path)
    {
        $res = \Loom\System\Config::fromIni($path);
        $this->assertTrue($res instanceof \Loom\System\Config);
    }



    /**
     * Test fromIni() using valid paths as File objects
     *
     * @test
     * @dataProvider getValidPaths
     * @covers       \Loom\Config::fromIni
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-07-01
     * @access       public
     * @return       void
     */
    public function testWithValidPathsAsFileObjects($path)
    {
        $file = \Loom\File::fromPath($path);
        $res  = \Loom\System\Config::fromIni($file);
        $this->assertTrue($res instanceof \Loom\System\Config);
    }



    /**
     * Test fromIni() using valid path, but file with invalid content
     *
     * @test
     * @covers \Loom\Config::fromIni
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-02
     * @access public
     * @return void
     */
    public function testInvalidContent()
    {
        $path = "tests/unit/System/Config/data/invalid.ini";
        \Loom\System\Config::fromIni($path);
    }
}
