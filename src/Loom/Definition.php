<?php

namespace Loom;

class Definition
{

    protected $fields = array();
    protected $valid = array();


    
    public function __construct(array $data)
    {
        $this->fields = $data;

        foreach ($data as $key => $val) {
            $this->valid[$key] = true;

            if (isset($val["children"])) {
                foreach ($val["children"] as $ckey => $cval) {
                    $this->valid[$cval["id"]] = true;
                }
            }
        }
    }

    public function get($field = null)
    {
        if ($field && isset($this->fields[$field])) {
            return $this->fields[$field];
        } else {
            return $this->fields;
        }
    }

    public function getFields()
    {
        $state  = \Loom\System\State::getInstance();
        $config = $state->getConfig();
        $ret    = array();
        
        foreach ($this->fields as $key => $val) {

            if (isset($val["hidden"])) {
                continue;
            }

            $ret[$key]       = $val;
            $ret[$key]["id"] = $key;

            // if (isset($val["children"])) {
            //     foreach ($val["children"] as $ckey => $cval) {
            //         $cid = $cval["id"];
            //         $ret[$cid]       = $cval;
            //         $ret[$cid]["id"] = $ckey;
            //     }
            // }
            
            // $ret[$key]["viewBase"] = $this->viewBaseDir . $context . "/";
            // $ret[$key]["viewExt"]  = $this->viewExtension;
            // $ret[$key]["tpl"]      = sprintf("%s%s%s%s",
            //                                  $this->viewBaseDir,
            //                                  $context . "/",
            //                                  $val["type"],
            //                                  $this->viewExtension);

            // if (isset($val["wrapper"])) {
            //     $ret[$key]["wrapper"] = sprintf("%s/%s%s",
            //                                     $config->get("templates.wrapperDir"),
            //                                     $val["wrapper"],
            //                                     $config->get("templates.ext"));
            // } else {
            //     // $ret[$key]["wrapper"] = $this->getDefaultFieldWrapper();
            // }

            // if ($this->get($key)) {
            //     $ret[$key]["value"] = $this->get($key);
            // }
        }

        return $ret;
    }


    
    public function getKeys()
    {
        return array_keys($this->fields);
    }


    public function getNumKeys()
    {
        return count(array_keys($this->fields));
    }

    
    
    public function setFieldValues($field, array $values)
    {
        if (isset($this->fields[$field])) {
            $this->fields[$field]->setValues($values);
        }
    }


    
    public function getField($field)
    {
        if (isset($this->fields[$field])) {
            return $this->fields[$field];
        } else {
            return null;
        }
    }


    
    public function validate($key, $val)
    {
        // print_pre_r($key);
        // print_pre_r($this->fields);
        if (isset($this->valid[$key])) {
            return true;
        }
    }

    public function getFieldLabel($field, $key)
    {
        if (isset($this->fields[$field]["values"][$key])) {
            return $this->fields[$field]["values"][$key];
        } else {
            return $key;
        }
    }
    
}
