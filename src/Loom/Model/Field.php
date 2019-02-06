<?php
/**
 * Loom: Model
 * Copyright (c) 2017 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Model;

/**
 * Loom: Field
 *
 * A single field inside a model
 *
 * @package Loom
 * @version 2017-04-29
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Field
{

    private $id;
    private $data;


    
    public function __construct($id, array $input)
    {
        $this->id   = $id;
        $this->data = new \Loom\Settable();
        $this->data->setData($input);
    }


    
    public function getType()
    {
        return $this->get("type");
    }


    
    public function getLength()
    {
        return $this->get("length");
    }


    
    public function validateValue($value)
    {
        // FIXME: To be implemented
        return true;
    }
}
