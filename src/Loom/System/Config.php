<?php
/**
 * Loom: Config
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Config;

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
     * Constructor
     *
     * @static
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-01
     * @access public
     * @return void
     *
     * @param  array $data Array of data used to populate config object
     */
    public function __construct(array $data = null)
    {
        if (is_array($data) && count($data) > 0) {
            $this->data = $data;
        }
    }



    /**
     * Initialize from YAML
     *
     * FIXME: I don't really like the silencing @ in front of
     * yaml_parse_file(), but it seems it is not otherwise quitely
     * returning the expected failure value.
     *
     * @static
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-01
     * @access public
     * @return void
     *
     * @param  mixed $input File object or file path to config file
     */
    public static function fromYaml($input)
    {
        if (extension_loaded("yaml")) {
            $file = static::getReadableFile($input);
            
            if ($file instanceof \Loom\File) {
                $arr = @yaml_parse_file($file->getPath());
                
                if (is_array($arr)) {
                    return new \Loom\Config($arr);
                }
            }
        }
        
        return null;
    }



    /**
     * Initialize from .ini
     *
     * FIXME: I don't really like the silenting @ in front of
     * parse_ini_file(), but it seems it is not otherwise quitely
     * returning the expected failure value.
     *
     * @static
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-01
     * @access public
     * @return void
     *
     * @param  mixed $input File object or file path to config file
     */
    public static function fromIni($input)
    {
        $file = static::getReadableFile($input);
        
        if ($file instanceof \Loom\File) {
            $arr = @parse_ini_file($file->getPath());

            if (is_array($arr)) {
                return new \Loom\Config($arr);
            }
        }
        
        return null;
    }



    /**
     * Common checking and handling for all the static factory methods
     *
     * @static
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-01
     * @access private
     * @return void
     *
     * @param  mixed $input File object or file path to config file
     */
    private static function getReadableFile($input)
    {
        if (!((is_string($input) && !empty($input)) || $input instanceof \Loom\File)) {
            return null;
        }

        if (is_string($input)) {
            $file = \Loom\File::fromPath($input);
        } else {
            $file = $input;
        }

        if ($file->exists() && $file->isReadable()) {
            return $file;
        }

        return null;
    }
}
