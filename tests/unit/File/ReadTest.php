<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\File;

/**
 * Loom: Unit tests for File::read()
 *
 * - Exists and readable
 * - Exists, not readable
 * - Does not exist 
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-29
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ReadTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test reading a file that exists and is readable
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-29
     * @access public
     * @return void
     */
    public function testReadable()
    {
        $path   = __DIR__ . "/somedir/somefile.txt";
        $file   = new \Loom\File($path);
        $strLen = 56;
        
        $this->assertTrue($file->read());
        $this->assertEquals($strLen, strlen($file->getContent()));
    }



    /**
     * Test reading a file that exists but is not readable
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-29
     * @access public
     * @return void
     */
    public function testNotReadable()
    {
        $path = __DIR__ . "/somedir/some-other-file.txt";
        $file = new \Loom\File($path);

        touch($path);
        chmod($path, 0000);
        
        $this->assertFalse($file->read());
        $this->assertEmpty($file->getContent());

        unlink($path);
    }



    /**
     * Test reading a file that does not exist
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-29
     * @access public
     * @return void
     */
    public function testNonExistent()
    {
        $path = __DIR__ . "/somedir/yet-another-file.txt";
        $file = new \Loom\File($path);
        
        $this->assertFalse($file->read());
        $this->assertEmpty($file->getContent());
    }
}
