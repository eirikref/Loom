<?php
/**
 * Loom: RestApi
 * Copyright (c) 2013-2016 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: RestApi
 *
 *
 *
 * @package Loom
 * @version 2016-10-17
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class RestApi
{

    private $model;
    private $request;
    private $resource;
    private $response;
    private $renderer;


    
    /**
     * Constructor
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2015-07-21
     * @access public
     * @return void
     */
    public function __construct($spec, $request)
    {
        $this->model    = new \Loom\RestApi\OpenApi($spec);
        $this->request  = $request;
        $this->response = new \Loom\RestApi\Response();
        $this->renderer = new \Loom\RestApi\Renderer();
    }


    
    public function dispatch()
    {
        $this->resource = $this->match();

        if ($this->resource instanceof \Loom\RestApi\Resource) {
            if ($this->hasRequiredParams()) {
                return $this->resource;
            } else {
                $this->response->setError("title", "Missing required parameters. See documentation.");
                $this->response->setHttpStatus(400);
                $this->response->setState(1);
            }
        } else {
            $this->response->setState(1);
        }
    }


    
    private function match()
    {
        $path   = $this->request->getPath();
        $list   = $this->model->getResources();
        $method = $this->request->getMethod();
        $reqUrl = $this->request->getUrl();

        // Perfect match
        if (isset($list[$path][$method])) {
            $this->response->setDebug("Route", $reqUrl->getPath());
            $this->response->setDebug("RestApi::match()", "Perfect match");
            return $list[$path][$method];

        // Match path with parameter
        } else {
            foreach ($list as $lPath => $lMethods) {
                $lUrl = new \Loom\Url($lPath);

                if ($reqUrl->getPathSize() != $lUrl->getPathSize()) {
                    continue;
                }

                $i = 0;
                $size = $reqUrl->getPathSize();
                $stillPossible = true;

                while ($i < $size && $stillPossible === true) {
                    $lVal = $lUrl->getPathElement($i);
                    $rVal = $reqUrl->getPathElement($i);
                    ++$i;

                    if (substr($lVal, 0, 1) == "{" &&
                        substr($lVal, -1, 1) == "}") {
                        continue;
                    } elseif ($lVal != $rVal) {
                        $stillPossible = false;
                        continue;
                    }
                }

                if ($stillPossible === true) {
                    $this->response->setDebug("Route", $lUrl->getPath());

                    if (isset($list[$lPath][$method])) {
                        $this->response->setDebug("RestApi::match()", "Parameter match");
                        return $list[$lPath][$method];
                    } else {
                        $this->response->setDebug("RestApi::match()", "Path match, but not method");
                        $this->response->setHttpStatus(405);
                        return;
                    }
                }
            }
            
            $this->response->setHttpStatus(404);
            $this->response->setDebug("RestApi::match()", "no matches");

            return;
        }
    }



    public function &getResponse()
    {
        // print_pre_r($this->response);
        return $this->response;
    }



    public function &getRequest()
    {
        return $this->request;
    }



    public function &getResource()
    {
        return $this->resource;
    }


    public function getBasePath()
    {
        return $this->model->getBasePath();
    }


    // FIXME
    public function render()
    {
        $this->renderer->render($this);
    }


    
    public function getResources()
    {
        return $this->model->getResources();
    }


    
    public function hasRequiredParams()
    {
        $required = $this->resource->getRequiredParams();
        $url      = $this->request->getUrl();

        if (count($required) > 0) {
            foreach ($required as $param => $type) {
                if (!$url->hasParam($param)) {
                    return false;
                }
            }
        }

        return true;
    }



    public function addPaths(array $paths)
    {
        $this->model->addPaths($paths);
    }



    public function addDefinitions(array $defs)
    {
        $this->model->addDefinitions($defs);
    }
}
