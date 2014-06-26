<?php
/**
 * Loom: Directory
 * Copyright (c) 2013-2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: Directory
 *
 * - create a new dir
 * - change permissions on existing dir
 * - read files in dir, possibly recursively
 * - read subset of files (given pattern)
 *
 * @package Loom
 * @version 2014-05-30
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Directory
{

    /**
     * File path
     *
     * @var    string $path
     * @access private
     */
    private $path;



    public static function fromPath($path)
    {
        if ($this->validatePath($path)) {
            return new \Loom\Directory($p);
        }
    }



    /**
     * Constructor
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-20
     * @access public
     * @return void
     *
     * @param  string $path The directory path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }



    /**
     * Set path. Currentty copied from File. Should consider making an
     * interface or a super class.
     *
     * FIXME: Should probably not allow just about anything? Check to
     * see that the path actually points to a file (ie. not a file,
     * what about symlinks?). And probably within allowed dirs?
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-31
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
     * @since  2014-05-31
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
     * @since  2014-05-31
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



    public function create($mode = 0777, $recursive = false)
    {
    }

    public function delete($recursive = false)
    {
    }

    public function exists()
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
