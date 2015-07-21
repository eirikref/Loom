<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\RestApi;

/**
 * Loom: Unit tests for RestApi::fromYaml()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-07-17
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class ApiFromYamlTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test RestApi::fromYaml() with a non-existent file
     *
     * @test
     * @covers \Loom\RestApi::fromYaml
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-17
     * @access public
     * @return void
     */
    public function testFromYamlWithNonExistentFile()
    {
        $path   = "./tests/unit/RestApi/files/nosuchfile.yaml";
        $file   = \Loom\File::fromPath($path);
        $router = \Loom\RestApi::fromYaml($file);

        // $this->assertNull($router);
    }



    /**
     * Test RestApi::fromYaml() with an empty file
     *
     * @test
     * @covers \Loom\RestApi::fromYaml
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-22
     * @access public
     * @return void
     */
    public function testFromYamlWithEmptyFile()
    {
        $path   = "./tests/unit/RestApi/files/empty.yaml";
        $file   = \Loom\File::fromPath($path);
        $router = \Loom\RestApi::fromYaml($file);

        // $this->assertNull($router);
    }



    /**
     * Test RestApi::fromYaml() with a valid file
     *
     * @test
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-22
     * @access public
     * @return void
     */
    public function testFromYamlWithValidFile()
    {
        $path   = "./tests/unit/RestApi/files/valid.yaml";
        $file   = \Loom\File::fromPath($path);
        $router = \Loom\RestApi::fromYaml($file);

        // $this->assertTrue($router instanceof \Loom\RestApi);
    }
}
