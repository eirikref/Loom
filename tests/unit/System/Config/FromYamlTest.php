<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Config;

/**
 * Loom: Unit tests for Config::fromYaml()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-07-01
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class FromYamlTest extends \PHPUnit_Framework_TestCase
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
     * Test fromYaml() using invalid path value
     *
     * @test
     * @dataProvider getInvalidPaths
     * @covers       \Loom\System\Config::fromYaml
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-07-01
     * @access       public
     * @return       void
     */
    public function testWithInvalidPaths($path)
    {
        $this->assertNull(\Loom\System\Config::fromYaml($path));
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
     * Test fromYaml() using valid, but non-existent, paths
     *
     * @test
     * @dataProvider getValidButNonExistentPaths
     * @covers       \Loom\System\Config::fromYaml
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-07-01
     * @access       public
     * @return       void
     */
    public function testWithValidButNonExistentPaths($path)
    {
        $this->assertNull(\Loom\System\Config::fromYaml($path));
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
            array("tests/unit/Config/data/simple.yaml"),
        );
    }



    /**
     * Test fromYaml() using valid paths
     *
     * @test
     * @dataProvider getValidPaths
     * @covers       \Loom\System\Config::fromYaml
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-07-01
     * @access       public
     * @return       void
     */
    public function testWithValidPaths($path)
    {
        if (!extension_loaded("yaml")) {
            return;
        }

        $res = \Loom\System\Config::fromYaml($path);
        $this->assertTrue($res instanceof \Loom\System\Config);
    }



    /**
     * Test fromYaml() using valid paths as File objects
     *
     * @test
     * @dataProvider getValidPaths
     * @covers       \Loom\System\Config::fromYaml
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-07-01
     * @access       public
     * @return       void
     */
    public function testWithValidPathsAsFileObjects($path)
    {
        if (!extension_loaded("yaml")) {
            return;
        }

        $file = \Loom\File::fromPath($path);
        $res  = \Loom\System\Config::fromYaml($file);
        $this->assertTrue($res instanceof \Loom\System\Config);
    }



    /**
     * Test fromYaml() using valid path, but file with invalid content
     *
     * @test
     * @covers \Loom\System\Config::fromYaml
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-02
     * @access public
     * @return void
     */
    public function testInvalidContent()
    {
        $path = "tests/unit/Config/data/invalid.yaml";
        \Loom\System\Config::fromYaml($path);
    }
}
