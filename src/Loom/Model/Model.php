<?php
/**
 * Loom: Model
 * Copyright (c) 2017 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\Model;

/**
 * Loom: Model
 *
 * A model is a representation of an entity/class/object, with a
 * strict definition based on given configuration, and is the basis
 * for handling ORM-like behavior, validation of data, transformation
 * into ie. JSON representation, database schema representation, and
 * so on.
 *
 * @package Loom
 * @version 2017-04-16
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Model
{

    private $data;
    private $fields = array();


    
    public function __construct(array $input)
    {
        if (isset($input["fields"])) {
            $tmp = $input["fields"];
            unset($input["fields"]);

            foreach ($tmp as $id => $val) {
                $f = new \Loom\Model\Field($id, $val);
                $this->fields[$id] = $f;
            }
        }
        
        $this->data = new \Loom\Settable();
        $this->data->setData($input);
    }


    
    public function getFields()
    {
        return array_keys($this->fields);
    }


    
    public function getField($id)
    {
        if (isset($this->fields[$id])) {
            return $this->fields[$id];
        }
    }
}
