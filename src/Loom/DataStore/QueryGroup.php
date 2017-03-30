<?php

namespace Loom\DataStore;

class QueryGroup
{

    protected $parent;


    
    public function setParent($parent)
    {
        $this->parent = $parent;
    }


    protected function query($query, array $args = null)
    {
        // print_pre_r($this->parent);
        return $this->parent->queryBackend($query, $args);
    }

    protected function getParent()
    {
        return $this->parent;
    }
}
