<?php

namespace Loom;

class Breadcrumbs
{

    protected $data = array();


    
    public function set(array $in)
    {
        empty($this->data);
        
        foreach ($in as $key => $val) {
            if (isset($val["url"]) && isset($val["title"])) {
                $this->add($val["url"], $val["title"]);
            }
        }
    }

    public function add($url, $title)
    {
        $this->data[] = array("url" => $url,
                              "title" => $title);
    }

    public function get()
    {
        return $this->data;
    }

    public function reset()
    {
        $this->data = [];
    }
}
