<?php
/**
 * Loom: Model Manager
 * Copyright (c) 2017 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Model;

/**
 * Loom: Model Manager
 *
 * Responsible for reading and parsing the model configuration,
 * instantiate models, and respond to model lookup requests.
 *
 * @package Loom
 * @version 2017-04-17
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class ModelManager extends \Loom\GenericManager
{

    public function __construct(\Loom\File $file)
    {
        if (!$file->exists() || !$file->isReadable()) {
            return;
        }

        $file->read();
        $json = $file->getContent();
        $data = json_decode($json, true);
        $arr  = array();

        foreach ($data as $key => $val) {
            $arr[$key] = new \Loom\Model\Model($val);
        }

        $this->setData($arr);
    }
        
}
