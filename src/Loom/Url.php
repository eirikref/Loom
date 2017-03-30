<?php
/**
 * Loom: Url
 * Copyright (c) 2016 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: URL
 *
 * @package Loom
 * @version 2016-09-06
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Url extends Settable
{
    
    private $maxLength = 4096;


    
    public function __construct($url = null)
    {
        if (isset($url)) {
            $this->setUrl($url);
        }
    }


    
    public function setUrl($url)
    {
        if (is_string($url) && strlen($url) <= $this->maxLength) {
            empty($this->data);
            $this->set("url", $url);
        }

        $this->set("parseurl", parse_url($url));
        $this->set("path", $this->parsePath($this->get("parseurl.path")));

        if ($this->get("parseurl.query")) {
            parse_str($this->get("parseurl.query"), $params);
            $this->set("params", $params);
        }
    }


    
    private function parsePath($in)
    {
        if (!is_string($in) || strlen($in) > $this->maxLength) {
            return false;
        }

        $in = trim($in, "/");
        
        return explode("/", $in);
    }


    
    public function getPath()
    {
        return $this->get("parseurl.path");
    }


    
    public function getPathSize()
    {
        return count($this->get("path"));
    }


    
    public function getPathElement($i)
    {
        if ($i <= $this->getPathSize()) {
            return $this->get("path.$i");
        }
    }



    public function getLastElement()
    {
        return end($this->get("path"));
    }
    


    public function getFirstElement()
    {
        return $this->getPathElement(0);
    }
    


    public function getPathElements()
    {
        return $this->get("path");
    }


    
    public function getPathTo($n)
    {
        $path = $this->get("parseurl.path");

        if (!is_int($n)) {
            return null;
        }
        
        if ($n < 1 || $n > $this->maxLength) {
            return null;
        }

        if (strlen($path) < $n) {
            return null;
        }

        return substr($path, 0, $n);
    }        


    
    public function getParams()
    {
        return $this->get("params");
    }



    public function hasParam($p)
    {
        if ($this->get("params.$p")) {
            return true;
        } else {
            return false;
        }
    }



    public function getParam($p)
    {
        return $this->get("params.$p");
    }

}
