<?php
/**
 * Loom: HttpRequest
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: HttpRequest
 *
 * @package Loom
 * @version 2014-10-09
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class HttpRequest
{
    private $url;
    private $response;
    private $meta;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getResponse()
    {
    }

    public function getMeta()
    {
    }

}
