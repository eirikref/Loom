<?php
/**
 * Loom: File
 * Copyright (c) 2013-2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: File
 *
 * Class representing a generic file on a file system
 *
 * @package Loom
 * @version 2014-06-27
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class File
{
    
    /**
     * File path
     *
     * @var    string $path
     * @access private
     */
    private $path;

    /**
     * File content
     *
     * @var    string $content
     * @access private
     */
    private $content;
    


    /**
     * De facto constructor
     *
     * @static
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-31
     * @access public
     * @return void
     *
     * @param  string $path The file path
     */
    public static function fromPath($path)
    {
        if ($path && self::validatePath($path)) {
            $file = new \Loom\File();
            $file->setPath($path);

            return $file;
        }

        return null;
    }



    /**
     * Validate path
     *
     * Obviously not nearly done. More of a placeholder in order to
     * allow for checking paths later on.
     *
     * FIXME: Should probably not allow just about anything? Check to
     * see that the path actually points to a file (ie. not a dir,
     * what about symlinks?). And probably within allowed dirs?
     *
     * @static
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-06-26
     * @access private
     * @return bool
     *
     * @param  string $path The file path
     */
    private static function validatePath($path)
    {
        $valid = false;

        if (!is_string($path) || empty($path)) {
            $valid = false;
        } else {
            $valid = true;
        }

        return $valid;
    }



    /**
     * Set path
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-15
     * @access private
     * @return bool
     *
     * @param  string $path The file path
     */
    private function setPath($path)
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

        if (!isset($_SERVER["PWD"])) {
            // error_log("error error");
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



    /**
     * Check if the file exists
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-14
     * @access public
     * @return boolean True if the file exists, otherwise false
     */
    public function exists()
    {
        if (file_exists($this->path)) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Check if the file is readable
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-14
     * @access public
     * @return boolean True if the file is readable, otherwise false
     */
    public function isReadable()
    {
        if (is_readable($this->path)) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Check if the file is writable
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-14
     * @access public
     * @return boolean True if the file is writable, otherwise false
     */
    public function isWritable()
    {
        if (is_writable($this->path)) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Set content
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-14
     * @access public
     * @return void
     *
     * @param  string $content The file content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }



    /**
     * Get content
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-28
     * @access public
     * @return void
     */
    public function getContent()
    {
        return $this->content;
    }



    /**
     * Read the file
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-14
     * @access public
     * @return boolean True if able to read, otherwise false
     */
    public function read()
    {
        if ($this->isReadable()) {
            $this->content = file_get_contents($this->path);
            return true;
        }

        return false;
    }



    /**
     * Write the file
     *
     * FIXME: What about creating new files?
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-05-14
     * @access public
     * @return boolean True if the write is successful, otherwise false
     */
    public function write()
    {
        if ($this->isWritable()) {
            $fp  = fopen($this->path, 'w');
            $ret = fwrite($fp, $this->content);
            fclose($fp);
            return true;
        }

        return false;
    }
}
