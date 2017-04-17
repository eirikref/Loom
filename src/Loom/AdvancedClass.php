<?php
/**
 * Loom: Advanced Class
 * Copyright (c) 2017 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: Advanced Class
 *
 * What's in an advanced class? Well, at least a silly name. The
 * second I come up with a more sensible name that I feel better
 * matches the concept, the name will change.
 *
 * Other than that:
 * - Supports a model
 * - Supports ORM-like functionality
 * - 
 *
 * @package Loom
 * @version 2017-04-16
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class AdvancedClass
{

    protected $data;
    protected $dbh;
    protected $mgr;
    
    public function __construct($mgr = null, $dbh = null)
    {
        $this->data = new \Loom\Settable();

        if ($mgr instanceof \Loom\ModelManager) {
            $this->mgr = $mgr;
        }

        if ($dbh) {
            $this->dbh = $dbh;
        }
    }

    public function setData()
    {
    }

    public function toJson()
    {
    }

    public function create()
    {
    }

    public function read()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }

}
