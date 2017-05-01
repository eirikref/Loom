<?php

namespace Loom;

class GenericManager
{

    protected $list = array();


    
    public function __construct(array $input)
    {
        $this->setData($input);
    }


    
    public function setData(array $input)
    {
        $this->list = $input;
    }

    

    public function has($id)
    {
        if (isset($this->list[$id])) {
            return true;
        } else {
            return false;
        }
    }



    public function get($id)
    {
        if (isset($this->list[$id])) {
            return $this->list[$id];
        } else {
            return null;
        }
    }



    public function getList()
    {
        return $this->list;
    }

    
    
    public function getKeys()
    {
        return array_flip(array_keys($this->list));
    }
    
}

