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
     * @var    string $content
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
    private function __construct($data)
    {
        $this->routes = $data;
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
    public static function fromYaml(\Loom\File $file)
    {
        if (extension_loaded("yaml")) {
            if ($file->exists() and $file->isReadable()) {
                $data = parse_yaml_file($file->getPath());

                $router = new \Loom\Router($data);
                
                return $router;
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
    public function match($something)
    {
    }
}
