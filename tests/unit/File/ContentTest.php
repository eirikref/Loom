<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\File;
use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for File::setContent() and File::getContent()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-05-29
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ContentTest extends TestCase
{

    /**
     * Data provider with all kinds of non-string data
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-29
     * @access public
     * @return array
     */
    public function getNonStrings()
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
     * Test setting and getting content using non-strings
     *
     * @test
     * @dataProvider getNonStrings
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-29
     * @access       public
     * @return       void
     */
    public function testNonStrings($content)
    {
        $file = new \Loom\File();
        $file->setContent($content);
        $this->assertEquals($content, $file->getContent());
    }



    /**
     * Data provider with string data
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-29
     * @access public
     * @return array
     */
    public function getStrings()
    {
        return array(
            array("abc")
        );
    }



    /**
     * Test setting and getting content using strings
     *
     * @test
     * @dataProvider getStrings
     * @author       Eirik Refsdal <eirikref@gmail.com>
     * @since        2014-05-29
     * @access       public
     * @return       void
     */
    public function testStrings($content)
    {
        $file = new \Loom\File();
        $file->setContent($content);
        $this->assertEquals($content, $file->getContent());
    }
}
