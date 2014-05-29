<?php
/**
 * Loom: Directory
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: Directory
 *
 *
 *
 * @package Loom
 * @version 2013-06-21
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Directory
{

    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function create($mode = 0777, $recursive = false)
    {
    }

    public function delete($recursive = false)
    {
    }

    public function isReadable()
    {
    }

    public function isWritable()
    {
    }

    public function read($recursive = false)
    {
    }

    public function getTree()
    {
    }
}
