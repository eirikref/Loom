<?php
/**
 * Loom: Config
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: Config
 *
 * Class containing any kind of configuration
 *
 * - Read from file
 * - JSON, YAML, XML, and INI?
 * - Create from scratch, populate at will
 * - Write to file? (Not a priority)
 * - ...
 *
 * @package Loom
 * @version 2014-07-01
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Config extends \Loom\Settable
{

    /**
     * Is the config instance ready or not?
     *
     * @var    bool $ready
     * @access private
     */
    private $ready = true;



    /**
     * Initialize from YAML
     *
     * @static
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-01
     * @access public
     * @return void
     *
     * @param  mixed $file File object or file path to config file
     */
    public static function fromYaml($file)
    {
        if (!((is_string($file) && !empty($file)) || $file instanceof \Loom\File)) {
            return null;
        }

        if ($file instanceof \Loom\File) {
            $path = $file->getPath();
        } else {
            $path = $file;
        }

        // yaml_parse_file($path);
        
    }



    /**
     * Initialize from .ini
     *
     * @static
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-01
     * @access public
     * @return void
     *
     * @param  mixed $file File object or file path to config file
     */
    public static function fromIni($file)
    {
        if (!((is_string($file) && !empty($file)) || $file instanceof \Loom\File)) {
            return null;
        }

        if ($file instanceof \Loom\File) {
            $path = $file->getPath();
        } else {
            $path = $file;
        }

        parse_ini_file($path);
        
    }



    /* private function read($input) */
    /* { */
    /*     $file = null; */

    /*     if ($input instanceof \Loom\File) { */
    /*         $file = $input; */
    /*     } elseif (is_string($input)) { */
    /*         $file = new \Loom\File($input); */
    /*     } */

    /*     if (!(isset($file) && $file->isReadable())) { */
    /*         // handle something */
    /*         // Log error */
    /*         return false; */
    /*     } */

    /*     switch ($file->getExtension()) { */
    /*         case 'yaml': */
    /*             $this->readYaml($file); */
    /*             break; */

    /*         /\* case 'ini': *\/ */
    /*         /\*     $this->readIni($file); *\/ */
    /*         /\*     break; *\/ */

    /*         default: */
    /*             break; */
    /*     } */
    /* } */

    /* private function readYaml($file) */
    /* { */
    /* } */
    
    private function isReady()
    {
        return $this->ready;
    }
}
