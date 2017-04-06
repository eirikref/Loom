<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Config;

/**
 * Loom: Unit tests for Config::getReadableFile()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-07-02
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class GetReadableFileTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Data provider with all kinds of invalid values
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-02
     * @access public
     * @return array
     */
    public function getInvalidValues()
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
     * Test getReadableFile() using invalid input values
     *
     * @test
     * @dataProvider getInvalidValues
     * @covers       \Loom\System\Config::getReadableFile
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-07-02
     * @access       public
     * @return       void
     */
    public function testWithInvalidValues($input)
    {
        $class  = $this->getMock("\Loom\System\Config");
        $method = new \ReflectionMethod($class, "getReadableFile");
        $method->setAccessible(true);

        $result = $method->invoke($class, $input);
        $this->assertNull($result);
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
     * Test getReadableFile() using valid but non-existent path values
     *
     * @test
     * @dataProvider getValidButNonExistentPaths
     * @covers       \Loom\System\Config::getReadableFile
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-07-02
     * @access       public
     * @return       void
     */
    public function testWithValidButNonExistentValues($input)
    {
        $class  = $this->getMock("\Loom\System\Config");
        $method = new \ReflectionMethod($class, "getReadableFile");
        $method->setAccessible(true);

        $result = $method->invoke($class, $input);
        $this->assertNull($result);
    }



    /**
     * Data provider with valid paths that do exist
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-02
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
     * Test getReadableFile() using valid paths
     *
     * @test
     * @dataProvider getValidPaths
     * @covers       \Loom\System\Config::getReadableFile
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-07-02
     * @access       public
     * @return       void
     */
    public function testWithValidPaths($path)
    {
        $class  = $this->getMock("\Loom\System\Config");
        $method = new \ReflectionMethod($class, "getReadableFile");
        $method->setAccessible(true);

        $result = $method->invoke($class, $path);
        $this->assertTrue($result instanceof \Loom\File);
    }



    /**
     * Test getReadableFile() using valid paths as File objects
     *
     * @test
     * @dataProvider getValidPaths
     * @covers       \Loom\System\Config::getReadableFile
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-07-02
     * @access       public
     * @return       void
     */
    public function testWithValidPathsAsFileObjects($path)
    {
        $file   = \Loom\File::fromPath($path);
        $class  = $this->getMock("\Loom\System\Config");
        $method = new \ReflectionMethod($class, "getReadableFile");
        $method->setAccessible(true);

        $result = $method->invoke($class, $file);
        $this->assertTrue($result instanceof \Loom\File);
    }



    /**
     * Test fromIni() using valid path, but file with invalid content
     *
     * @test
     * @covers \Loom\System\Config::fromIni
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
