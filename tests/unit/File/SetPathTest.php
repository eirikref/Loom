<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\File;

use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for File::setPath()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-26
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class SetPathTest extends TestCase
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
     * @covers       \Loom\File::setPath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-26
     * @access       public
     * @return       void
     */
    public function testWithInvalidPaths($path)
    {
        $reflection = $this->createMock("\Loom\File");
        $method = new \ReflectionMethod($reflection, "setPath");
        $method->setAccessible(true);

        $result = $method->invoke($reflection, $path);
        $this->assertFalse($result);
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
     * @covers       \Loom\File::setPath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-26
     * @access       public
     * @return       void
     */
    public function testWithValidPaths($path)
    {
        $reflection = $this->createMock("\Loom\File");
        $method = new \ReflectionMethod($reflection, "setPath");
        $method->setAccessible(true);

        $result = $method->invoke($reflection, $path);
        $this->assertTrue($result);
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
     * @covers       \Loom\File::setPath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-26
     * @access       public
     * @return       void
     */
    public function testWithIncompletePaths($input, $append)
    {
        $exp        = $_SERVER['PWD'] . $append;
        $reflection = $this->createMock("\Loom\File");
        $method = new \ReflectionMethod($reflection, "setPath");
        $method->setAccessible(true);
        
        $this->assertTrue($method->invoke($reflection, $input));
        // $this->assertEquals($exp, $reflection->getPath());
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
     * @covers       \Loom\File::setPath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-26
     * @access       public
     * @return       void
     */
    public function testWithDoubleDotPaths($input, $numRemove, $append)
    {
        $reflection = $this->createMock("\Loom\File");
        $method = new \ReflectionMethod($reflection, "setPath");
        $method->setAccessible(true);

        $parts = explode("/", $_SERVER["PWD"]);
        for ($i = 0; $i < $numRemove; ++$i) {
            array_pop($parts);
        }
        $exp = implode("/", $parts) . $append;

        $this->assertTrue($method->invoke($reflection, $input));
        // $this->assertEquals($exp, $reflection->getPath());
    }
}
