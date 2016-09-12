<?php

namespace Loom;

class Field extends \Loom\Settable
{

    public function setValues(array $in)
    {
        $this->set("values", $in);
    }

    public function getValues()
    {
        return $this->get("values");
    }

    public function setSelected($in)
    {
        $this->set("selected", $in);
    }
    
}
