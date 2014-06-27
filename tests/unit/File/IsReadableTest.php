<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\File;

/**
 * Loom: Unit tests for File::isReadable()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-28
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class IsReadableTest extends \PHPUnit_Framework_TestCase
{

    /**
     * File path
     *
     * @var    string $path
     * @access private
     */
    private $path;



    /**
     * Set up test environment
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-28
     * @access protected
     * @return void
     */
    protected function setup()
    {
        $this->path = __DIR__ . "/somedir/file-with-permissions";
        
        if (file_exists($this->path)) {
            die("Exit in a better way :)");
        }

        touch($this->path);
    }



    /**
     * Tear down environment
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-28
     * @access protected
     * @return void
     */
    protected function tearDown()
    {
        unlink($this->path);
    }



    /**
     * Check if the file is readable
     *
     * @test
     * @covers \Loom\File::isReadable
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-28
     * @access public
     * @return void
     */
    public function testReadableFile()
    {
        chmod($this->path, 0644);

        $file = \Loom\File::fromPath($this->path);
        $this->assertTrue($file->isReadable());
    }



    /**
     * Check a file that is not readable
     *
     * @test
     * @covers \Loom\File::isReadable
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-28
     * @access public
     * @return void
     */
    public function testNonReadableFile()
    {
        chmod($this->path, 0000);

        $file = \Loom\File::fromPath($this->path);
        $this->assertFalse($file->isReadable());
    }
}
