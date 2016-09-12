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
    }

    private function parsePath($in)
    {
        if (!is_string($in) || strlen($in) > $this->maxLength) {
            return false;
        }

        $in = trim($in, "/");
        
        return explode("/", $in);
    }

    public function getPathSize()
    {
        return count($this->get("path"));
    }

    public function getPathElement($i)
    {
        if ($i <= $this->getPathSize()) {
            $real = $i - 1;
            return $this->get("path.$real");
        }
    }
    
}
