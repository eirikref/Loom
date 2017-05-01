<?php
/**
 * Loom: Advanced Class
 * Copyright (c) 2017 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: Advanced Class
 *
 * What's in an advanced class? Well, at least a silly name. The
 * second I come up with a more sensible name that I feel better
 * matches the concept, the name will change.
 *
 * Other than that:
 * - Supports a model
 * - Supports ORM-like functionality
 * - 
 *
 * @package Loom
 * @version 2017-04-16
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class AdvancedClass
{

    protected $data;
    protected $store;
    protected $modelMgr;
    protected $model;


    
    public function __construct(&$modelMgr = null, &$store = null)
    {
        $this->data = new \Loom\Settable();
        
        if ($modelMgr instanceof \Loom\Model\ModelManager) {
            $this->modelMgr = $modelMgr;
        }

        if ($store instanceof \Loom\DataStore) {
            $this->store = $store;
        }

        $this->initModel(get_class($this));
    }



    protected function initModel($name)
    {
        if ($this->modelMgr instanceof \Loom\Model\ModelManager && $this->modelMgr->has($name)) {
            $this->model = $this->modelMgr->get($name);
        } else {
            print_pre_r($name);
            error_log("Unable to find module $name");
        }
    }

    
    public function setData(array $input)
    {
        foreach ($input as $field => $value) {
            $this->set($field, $value);
        }
    }



    public function set($id, $value)
    {
        if (!is_string($id)) {
            return false;
        }
        
        if ($this->model) {
            $field = $this->model->getField($id);

            if (!$field->validateValue($value)) {
                return false;
            }
        }

        return $this->data->set($id, $value);
    }

    
    
    public function toJson()
    {
        return $this->data->get();
    }


    
    public function create()
    {
    }


    
    public function read()
    {
    }


    
    public function update()
    {
    }


    
    public function delete()
    {
    }

}
