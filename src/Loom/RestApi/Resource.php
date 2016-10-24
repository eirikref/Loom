<?php
/**
 * Loom: RestApi\Resource
 * Copyright (c) 2016 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\RestApi;

/**
 * Loom: RestApi\Resource
 *
 *
 *
 * @package Loom
 * @version 2016-10-21
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Resource extends \Loom\Settable
{

    public function getRequiredParams()
    {
        $ret = array();
        
        foreach ($this->get("parameters") as $p) {
            if (1 == $p["required"]) {
                $key  = $p["name"];
                $type = $p["type"];

                $ret[$key] = $type;
            }
        }

        return $ret;
    }
    
}
