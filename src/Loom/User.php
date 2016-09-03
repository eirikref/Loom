<?php
/**
 * Loom: User
 * Copyright (c) 2016 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: User
 *
 * Class representing a user
 *
 * @package Loom
 * @version 2016-09-03
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class User extends Settable
{

    /**
     * Maximum length for a username
     *
     * @var    int $usernameMaxLength
     * @access protected
     */
    protected $usernameMaxLength = 32;

    

    /**
     * Constructor
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2016-09-03
     * @access public
     * @return void
     */
    public function __construct()
    {
    }



    /**
     * Set username
     */
    public function setUsername($input)
    {
        if (strlen($input) > 0 && strlen($input) < $this->usernameMaxLength) {
            return $this->set("username", $input);
        }
    }



    /**
     * Get username
     */
    public function getUsername()
    {
        return $this->get("username");
    }



    /**
     * Set name
     */
    public function setName($input)
    {
        return $this->set("name", $input);
    }



    /**
     * Get name
     */
    public function getName()
    {
        return $this->get("name");
    }



    /**
     * Set email
     */
    public function setEmail($input)
    {
        return $this->set("email", $input);
    }



    /**
     * Get email
     */
    public function getEmail()
    {
        return $this->get("email");
    }

}
