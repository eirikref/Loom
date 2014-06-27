<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Directory;

/**
 * Loom: Unit tests for Directory::resolvePath()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-28
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ResolvePathTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider with all kinds of invalid paths
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-28
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
     * Test resolvePath() using invalid path values
     *
     * @test
     * @dataProvider getInvalidPaths
     * @covers       \Loom\Directory::resolvePath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-28
     * @access       public
     * @return       void
     */
    public function testWithInvalidPaths($path)
    {
        $reflection = $this->getMock("\Loom\Directory");
        $method = new \ReflectionMethod($reflection, "resolvePath");
        $method->setAccessible(true);

        $result = $method->invoke($reflection, $path);
        $this->assertFalse($result);
    }



    /**
     * Data provider with all kinds of incomplete paths
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-28
     * @access public
     * @return array
     */
    public function getIncompleteAddPaths()
    {
        return array(
            array("subdir/file",   "/subdir/file"),
            array("file",          "/file"),
            array("./subdir/file", "/subdir/file"),
            array("./file",        "/file")
        );
    }



    /**
     * Test resolvePath() using incomplete paths
     *
     * @test
     * @dataProvider getIncompleteAddPaths
     * @covers       \Loom\Directory::resolvePath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-28
     * @access       public
     * @return       void
     */
    public function testWithIncompletePaths($input, $append)
    {
        $exp        = $_SERVER['PWD'] . $append;
        $reflection = $this->getMock("\Loom\Directory");
        $method     = new \ReflectionMethod($reflection, "resolvePath");
        $method->setAccessible(true);

        $result = $method->invoke($reflection, $input);
        $this->assertEquals($exp, $result);
    }



    /**
     * Data provider with incomplete paths containing double dots
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-28
     * @access public
     * @return array
     */
    public function getDoubleDotPaths()
    {
        return array(
            array("../subdir/file", 1, "/subdir/file"),
            array("../file",        1, "/file"),
            array("../../file",     2, "/file"),
        );
    }



    /**
     * Test setPath() using incomplete paths containing double dots
     *
     * @test
     * @dataProvider getDoubleDotPaths
     * @covers       \Loom\Directory::resolvePath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-28
     * @access       public
     * @return       void
     */
    public function testWithDoubleDotPaths($input, $numRemove, $append)
    {
        $reflection = $this->getMock("\Loom\Directory");
        $method     = new \ReflectionMethod($reflection, "resolvePath");
        $method->setAccessible(true);

        $parts = explode("/", $_SERVER["PWD"]);
        for ($i = 0; $i < $numRemove; ++$i) {
            array_pop($parts);
        }
        $exp = implode("/", $parts) . $append;

        $result = $method->invoke($reflection, $input);
        $this->assertEquals($exp, $result);
    }
}
