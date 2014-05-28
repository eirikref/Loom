<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\File;

/**
 * Loom: Unit tests for File::exists()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-28
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ExistsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Check for a file that exists
     *
     * @test
     * @covers \Loom\File::exists
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-28
     * @access public
     * @return void
     */
    public function testFileThatExists()
    {
        $path = __DIR__ . "/somedir/somefile.txt";
        $file = new \Loom\File($path);
        $this->assertTrue($file->exists());
    }



    /**
     * Check for a file that does not exist
     *
     * @test
     * @covers \Loom\File::exists
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-28
     * @access public
     * @return void
     */
    public function testFileThatDoesNotExist()
    {
        $path = __DIR__ . "/somedir/someotherfile.txt";
        $file = new \Loom\File($path);
        $this->assertFalse($file->exists());
    }
}
