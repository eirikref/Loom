<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\File;
use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for File::validatePath()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-06-30
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ValidatePathTest extends TestCase
{

    /**
     * Data provider with all kinds of invalid paths
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-06-27
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
     * Test validatePath() using invalid path value
     *
     * @test
     * @dataProvider getInvalidPaths
     * @covers       \Loom\File::validatePath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-06-27
     * @access       public
     * @return       void
     */
    public function testWithInvalidPaths($path)
    {
        $class  = $this->createMock("\Loom\File");
        $method = new \ReflectionMethod($class, "validatePath");
        $method->setAccessible(true);

        $result = $method->invoke($class, $path);
        $this->assertFalse($result);
    }



    /**
     * Data provider with all kinds of valid paths
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-06-27
     * @access public
     * @return array
     */
    public function getValidPaths()
    {
        return array(
            array("/some/path"),
            array("/usr/local/something"),
            array("/anything"),
            array("file.txt"),
        );
    }



    /**
     * Test validatePath() using valid path value
     *
     * @test
     * @dataProvider getValidPaths
     * @covers       \Loom\File::validatePath
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-06-27
     * @access       public
     * @return       void
     */
    public function testWithValidPaths($path)
    {
        $class  = $this->createMock("\Loom\File");
        $method = new \ReflectionMethod($class, "validatePath");
        $method->setAccessible(true);

        $result = $method->invoke($class, $path);
        $this->assertTrue($result);
    }
}
