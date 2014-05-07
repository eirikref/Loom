<?php
/**
 * Loom: File
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: File
 *
 * Class representing a generic file on a file system
 *
 * @package Loom
 * @version 2014-05-06
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class File
{

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->path     = $filename;
    }

    public function exists()
    {
        if (file_exists($this->path)) {
            return true;
        } else {
            return false;
        }
    }

    public function isReadable()
    {
        if (is_readable($this->path)) {
            return true;
        } else {
            return false;
        }
    }

    public function isWriteable()
    {
        if (is_writeable($this->path)) {
            return true;
        } else {
            return false;
        }
    }

    public function setContent($in)
    {
        $this->content = $in;
    }

    public function read()
    {
        if ($this->exists() && $this->isReadable()) {
            $this->content = file_get_contents($this->path);
        }
    }

    public function write()
    {
        // what if we're creating a new file?

        $ret = false;

        if ($this->isWriteable()) {
            $fp  = fopen($this->path, 'w');
            $ret = fwrite($fp, $this->content);
            fclose($fp);
        }

        return $ret;
    }
}
