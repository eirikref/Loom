<?php
/**
 * Loom: HttpRequestManager
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: HttpRequestManager
 *
 * @package Loom
 * @version 2014-10-09
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class HttpRequestManager
{
    private $requests = array();
    private $handles = array();

    public function add(&$request)
    {
        if (!$request instanceof \Loom\Request) {
            return;
        }

        $res = curl_init();

        curl_setopt($res, CURLOPT_URL, $request->getUrl());
        
        $this->requests[] = $request;
        $this->handles[]  = $res;
    }

    public function run()
    {
        if (count($this->requests) < 1) {
            return;
        }

        $mh = curl_multi_init();
        foreach ($this->requests as $id => $r) {
            curl_multi_add_handle($mh, $this->handles[$id]);
        }

        $active = null;
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        
        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        foreach ($this->requests as $id => $r) {
            curl_multi_remove_handle($mh, $this->handles[$id]);
        }
        curl_multi_close($mh);
    }
    
    public function reset()
    {
    }
}
