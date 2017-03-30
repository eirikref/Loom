<?php
/**
 * Loom: RestApi\Response
 * Copyright (c) 2016 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\RestApi;

/**
 * Loom: RestApi\Response
 *
 *
 *
 * @package Loom
 * @version 2016-10-18
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Response
{

    const OK = 0;
    const ERROR = 1;

    private $httpStatus = 500;
    private $data;
    private $meta;
    private $errors;
    private $debug;
    private $state;

    private $errorFields = ["id", "links", "code", "title", "detail", "source", "meta"];
    


    
    public function __construct()
    {
        $this->data   = new \Loom\Settable();
        $this->meta   = new \Loom\Settable();
        $this->errors = new \Loom\Settable();
        $this->debug  = new \Loom\Settable();

        $this->state = $this::ERROR;
    }



    public function setHttpStatus($code)
    {
        $this->httpStatus = $code;
    }

    

    public function getHttpStatus()
    {
        return $this->httpStatus;
    }
    

    
    public function setData($key, $val)
    {
        $this->data->set($key, $val);
    }


    
    public function setError($key, $val)
    {
        $this->errors->set($key, $val);
    }


    
    public function setMeta($key, $val)
    {
        $this->meta->set($key, $val);
    }


    
    public function setDebug($key, $val)
    {
        $this->debug->set($key, $val);
    }


    
    public function getState()
    {
        print_pre_r($this->state);
    }


    
    public function setState($param)
    {
        $this->state = $param;
    }



    private function populateErrors()
    {
        $ret = array();

        $ret["status"] = $this->httpStatus;

        foreach ($this->errorFields as $key => $val) {
            // $ret[$val] = "";
            if ($this->errors->get($val)) {
                $ret[$val] = $this->errors->get($val);
            }
        }

        return $ret;
    }


    
    public function get()
    {
        $ret = array();

        switch ($this->state) {

        case $this::OK:
            $ret["data"] = $this->data->get();
            break;

        case $this::ERROR:
            $ret["errors"] = $this->populateErrors();
            break;

        default:
        }

        $ret["debug"] = $this->debug->get();
                    
        return $ret;
    }

}
