<?php
/**
 * Loom: RestApi/OpenApi
 * Copyright (c) 2016 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\RestApi;

/**
 * Loom: RestApi/OpenApi
 *
 * OpenAPI parser and representation
 *
 * @package Loom
 * @version 2016-10-17
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class OpenApi implements \Loom\RestApi\Model
{

    private $spec;
    private $lookup = array();
    private $resources = array();


    
    /**
     * Constructor
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2016-10-17
     * @access public
     * @return void
     */
    public function __construct($specPath)
    {
        $this->spec = new \Loom\Settable();

        $json = $this->readSpec($specPath);
        $this->parseJson($json);

        // $json = file_get_contents($def);
        // $this->spec->setData(json_decode($json, true));
        // $this->createLookupTable();
        // print_pre_r($this->spec);
        // echo json_last_error();
    }

    

    private function readSpec($specPath)
    {
        if (!(file_exists($specPath) && is_readable($specPath))) {
            // FIXME: Error handling here
            return;
        }

        return file_get_contents($specPath);
    }


    
    private function parseJson($json)
    {
        $arrSpec = json_decode($json, true);
        $paths   = $arrSpec["paths"];
        unset($arrSpec["paths"]);

        $this->spec->setData($arrSpec);
        $this->addPaths($paths);
        // print_pre_r($this->resources);
    }


    
    public function getResource($resPath)
    {
        // $path = "paths." . $resPath;
        // return $this->spec->get($path);
        // print_pre_r($resPath);
        return $this->resources[$resPath];
    }


    
    public function getBasePath()
    {
        return $this->spec->get("basePath");
    }


    
    public function getResources()
    {
        return $this->resources;
    }


    
    public function addPaths(array $paths)
    {
        foreach ($paths as $path => $methods) {
            $path = $this->getBasePath() . $path;

            foreach ($methods as $m => $data) {
                $r = new \Loom\RestApi\Resource();
                $r->setData($data);
                $r->set("path", $path);
                $r->set("method", $m);
                // $key = "$path.$m";
                $this->resources[$path][$m] = $r;
                // print_pre_r($m);
                //print_pre_r($data);
            }
        }
    }



    public function addDefinitions(array $defs)
    {
        foreach ($defs as $key => $val) {
            $this->spec->set("definitions.$key", $val);
        }
    }
    

}
