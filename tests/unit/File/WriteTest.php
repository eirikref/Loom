<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\File;

/**
 * Loom: Unit tests for File::write()
 *
 * - Exists and writable
 * - Exists, not writable
 * - Does not exist
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-06-27
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class WriteTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test writing to a file that exists and is writable
     *
     * @test
     * @covers \Loom\File::write
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-29
     * @access public
     * @return void
     */
    public function testWritable()
    {
        $path    = __DIR__ . "/somedir/some-writable-file.txt";
        $file    = \Loom\File::fromPath($path);
        $content = "abc";

        touch($path);
        chmod($path, 0755);

        $file->setContent($content);
        $this->assertTrue($file->write());

        unset($file);
        $file = \Loom\File::fromPath($path);
        $file->read();

        $this->assertEquals($content, $file->getContent());

        unlink($path);
    }



    /**
     * Test writing to a file that exists but is not writable
     *
     * @test
     * @covers \Loom\File::write
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-29
     * @access public
     * @return void
     */
    public function testNotReadable()
    {
        $path    = __DIR__ . "/somedir/some-not-writable-file.txt";
        $file    = \Loom\File::fromPath($path);
        $content = "abc";

        touch($path);
        chmod($path, 0000);
        
        $file->setContent($content);
        $this->assertFalse($file->write());

        unset($file);
        chmod($path, 0755);
        $file = \Loom\File::fromPath($path);
        $file->read();

        $this->assertEmpty($file->getContent());

        unlink($path);
    }



    /**
     * Test writing to a file that does not exist
     *
     * @test
     * @covers \Loom\File::write
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-29
     * @access public
     * @return void
     */
    public function testNonExistent()
    {
        $path    = __DIR__ . "/somedir/some-file-that-does-not-exist.txt";
        $file    = \Loom\File::fromPath($path);
        $content = "abc";

        $file->setContent($content);
        $this->assertFalse($file->write());
    }
}
