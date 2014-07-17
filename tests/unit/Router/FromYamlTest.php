<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\Router;

/**
 * Loom: Unit tests for Router::fromYaml()
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2014-07-17
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class FromYamlTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test Router::fromYaml() with a non-existent file
     *
     * @test
     * @covers \Loom\Router::fromYaml
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-17
     * @access public
     * @return void
     */
    public function testFromYamlWithNonExistentFile()
    {
        $path   = "./files/nosuchfile.yaml";
        $file   = \Loom\File::fromPath($path);
        $router = \Loom\Router::fromYaml($file);

        $this->assertNull($router);
    }
}
