<?php
/**
 * Loom: RestApi\Renderer
 * Copyright (c) 2016 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\RestApi;

/**
 * Loom: RestApi\Renderer
 *
 *
 *
 * @package Loom
 * @version 2016-10-18
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Renderer
{

    public function render(\Loom\RestApi $api)
    {
        $resp =& $api->getResponse();

        http_response_code($resp->getHttpStatus());
        header("Content-Type: application/vnd.api+json");
        
        // print_pre_r($resp);
        
        $json = json_encode($resp->get());
        print $json;
    }

}
