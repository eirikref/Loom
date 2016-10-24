<?php
/**
 * Loom: Request
 * Copyright (c) 2016 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: Request
 *
 * @package Loom
 * @version 2016-10-21
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Request
{

    protected $url;
    protected $method;

    public function __construct($url = null)
    {
        if ($url) {
            $this->setUrl($url);
        }
    }

    public function setUrl($url)
    {
        if ($url instanceof \Loom\Url) {
            $this->url = $url;
        } elseif (is_string($url)) {
            $this->url = new \Loom\Url($url);
        }
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getPath()
    {
        if (isset($this->url)) {
            return $this->url->getPath();
        }
    }

    public function getPathSize()
    {
        if (isset($this->url)) {
            return $this->url->getPathSize();
        }
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParam($p)
    {
        return $this->url->getParam($p);
    }
    
}