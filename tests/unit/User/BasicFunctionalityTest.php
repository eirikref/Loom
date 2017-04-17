<?php
/**
 * Loom: Unit tests
 * Copyright (c) 2017 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Tests\Unit\User;
use PHPUnit\Framework\TestCase;

/**
 * Loom: Unit tests for basic functionality in User
 *
 * @package    Loom
 * @subpackage Tests
 * @version    2017-04-16
 * @author     Eirik Refsdal <eirikref@gmail.com>
 */
class BasicFunctionalityTest extends TestCase
{


    /**
     * Test state right after instantiation
     *
     * @test
     * @covers \Loom\User::getUsername
     * @covers \Loom\User::getName
     * @covers \Loom\User::getEmail
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2017-04-16
     * @access public
     * @return void
     */
    public function testStateAfterConstruct()
    {
        $user = new \Loom\User();

        $this->assertNull($user->getUsername());
        $this->assertNull($user->getEmail());
        $this->assertNull($user->getName());
    }
}
