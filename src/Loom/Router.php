<?php
/**
 * Loom: Router
 * Copyright (c) 2013-2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: Router
 *
 * - Decide on YAML format
 * - 
 *
 * @package Loom
 * @version 2014-07-17
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Router
{

    /**
     * Routes
     *
     * @var    array $routes
     * @access private
     */
    private $routes;



    /**
     * Constructor
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-17
     * @access private
     * @return object \Loom\Router object
     *
     * @param  array $data Array of routes
     */
    private function __construct(array $data, $prefix = null)
    {
        $this->routes = $data;

        if ($prefix) {
            $this->prefix = $prefix;
        }
    }


    
    /**
     * De facto constructor
     *
     * @static
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-17
     * @access public
     * @return mixed \Loom\Router or null
     *
     * @param  object $file A \Loom\File object
     */
    public static function fromYaml(\Loom\File $file, $prefix = null)
    {
        if (extension_loaded("yaml")) {
            if ($file->exists() and $file->isReadable()) {
                $data = @yaml_parse_file($file->getPath());

                if (is_array($data) && count($data) > 0) {
                    $router = new \Loom\Router($data, $prefix);
                    return $router;
                }
            }
        }

        return null;
    }



    /**
     * Match route. TBI.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-17
     * @access public
     * @return ?
     *
     * @param  ?
     */
    public function match($url, $method = "get")
    {
        
    }
}
