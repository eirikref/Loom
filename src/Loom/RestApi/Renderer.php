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
        $data =  $resp->get();

        http_response_code($resp->getHttpStatus());
        header("Content-Type: application/vnd.api+json");
        
        array_walk_recursive($data, function (&$item) {
            if ($item instanceof \Loom\AdvancedClass) {
                $item = $item->toApi();
            }
        });
        
        $json = json_encode($data);
        print $json;
    }
}
