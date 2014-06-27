<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Directory;

/**
 * Loom: Unit tests for Directory::setPath()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-26
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class SetPathTest extends \PHPUnit_Framework_TestCase
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
     * Test setPath() using invalid path value
     *
     * @test
     * @dataProvider getInvalidPaths
     * @covers       \Loom\Directory::setPath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-26
     * @access       public
     * @return       void
     */
    public function testWithInvalidPaths($path)
    {
        $file = new \Loom\Directory();
        $this->assertFalse($file->setPath($path));
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
     * Test setPath() using valid path value
     *
     * @test
     * @dataProvider getValidPaths
     * @covers       \Loom\Directory::setPath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-26
     * @access       public
     * @return       void
     */
    public function testWithValidPaths($path)
    {
        $file = new \Loom\Directory();
        $this->assertTrue(($file->setPath($path)));
    }



    /**
     * Data provider with all kinds of incomplete paths
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-26
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
     * Test setPath() using incomplete paths
     *
     * @test
     * @dataProvider getIncompleteAddPaths
     * @covers       \Loom\Directory::setPath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-26
     * @access       public
     * @return       void
     */
    public function testWithIncompletePaths($input, $append)
    {
        $file = new \Loom\Directory();
        $exp  = $_SERVER['PWD'] . $append;
        
        $this->assertTrue($file->setPath($input));
        $this->assertEquals($exp, $file->getPath());
    }



    /**
     * Data provider with incomplete paths containing double dots
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-26
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
     * @covers       \Loom\Directory::setPath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-26
     * @access       public
     * @return       void
     */
    public function testWithDoubleDotPaths($input, $numRemove, $append)
    {
        $file  = new \Loom\Directory();
        $parts = explode("/", $_SERVER["PWD"]);

        for ($i = 0; $i < $numRemove; ++$i) {
            array_pop($parts);
        }
        $exp = implode("/", $parts) . $append;
        
        $this->assertTrue($file->setPath($input));
        $this->assertEquals($exp, $file->getPath());
    }
}
