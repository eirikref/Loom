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
 * @version 2014-05-28
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class File
{
    
    private $inputPath;
    private $path;
    private $content;
    


    /**
     * Constructor
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-14
     * @access public
     * @return void
     *
     * @param  string $path The file path
     */
    public function __construct($path = null)
    {
        if ($path) {
            $this->setPath($path);
        }
    }



    /**
     * Set path
     *
     * FIXME: Should probably not allow just about anything? Check to
     * see that the path actually points to a file (ie. not a dir,
     * what about symlinks?). And probably within allowed dirs?
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-15
     * @access public
     * @return bool
     *
     * @param  string $path The file path
     */
    public function setPath($path)
    {
        if (!is_string($path) || empty($path)) {
            return false;
        }

        $this->inputPath = $path;

        if ("/" == substr($path, 0, 1)) {
            $this->path = $path;
        } else {
            $this->path = $this->resolvePath($path);
        }

        return true;
    }



    /**
     * Get path
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-26
     * @access public
     * @return mixed String if set, otherwise null
     */
    public function getPath()
    {
        return $this->path;
    }


    
    /**
     * Resolve path
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-26
     * @access private
     * @return string The resolved path
     *
     * @param  string $path The path to be resolved
     */
    private function resolvePath($path)
    {
        if (!is_string($path)) {
            return false;
        }

        $base   = explode("/", $_SERVER["PWD"]);
        $remove = 0;
        $add    = array();

        if ("./" == substr($path, 0, 2)) {
            $add = explode("/", substr($path, 2));
        } elseif ("../" == substr($path, 0, 3)) {
            $pattern = "/^(\.\.\/)+/";
            preg_match($pattern, $path, $matches);

            $dotsLen = strlen($matches[0]);
            $remove  = $dotsLen / 3;
            $add     = explode("/", substr($path, $dotsLen));
        } else {
            $add = explode("/", $path);
        }

        if ($remove > 0) {
            for ($i = 0; $i <= $remove - 1; ++$i) {
                array_pop($base);
            }
        }

        return implode("/", array_merge($base, $add));
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
