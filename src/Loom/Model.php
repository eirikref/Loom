<?php

namespace Loom;

class Model extends \Loom\Settable
{

    protected $definition;
    protected $fields;


    
    public function __construct()
    {
        
    }


    
    public function setDefinition(array $def)
    {
        $this->definition = new \Loom\Definition($def);
    }


    
    public function setData(array $data, $validate = false)
    {

        // print_pre_r($data);
        // print_pre_r($this->definition);
        $data = $this->prepare($data);
        
        foreach ($data as $key => $val) {
            if (false === $validate || (true === $validate &&
                                        isset($this->definition) &&
                                        $this->definition->validate($key, $val))) {


                $this->set($key, $val);
            }
        }
    }

    private function prepare($data)
    {
        $def = $this->definition->get();

        foreach ($data as $key => $val) {
            if (!(isset($def[$key]["type"]))) {
                continue;
            }

            $t = $def[$key]["type"];

            if ("checkboxes" == $t && is_string($val)) {
                // print_pre_r($key);
                $data[$key] = json_decode($val);
            }
        }
        
        return $data;
    }

    


    
    public function getValues()
    {
        $ret = array();

        foreach ($this->data as $key => $val) {
            if (is_array($val)) {
                $ret[$key] = json_encode($val);
            } else {
                $ret[$key] = $val;
            }
        }

        return $ret;
        // return array_values($this->data);
    }


    // 1. csv keys
    // 2. csv ?
    // 3. values
    public function getPdoRepresentation()
    {
        $ret    = array();
        $fields = array();
        $values = $this->getValues();
        
        foreach ($this->definition->get() as $key => $val) {
            if (isset($val["opts"]["nopdo"])) {
                continue;
            }

            $fields[] = $key;

            if (isset($val["children"])) {
                foreach ($val["children"] as $ckey => $cval) {
                    if (isset($cval["id"])) {
                        $fields[] = $cval["id"];
                    }
                }
            }
            
        }
        
        $ret["fields"]       = sprintf("(%s)", implode(", ", $fields));
        $ret["placeholders"] = sprintf("(%s)", substr(str_repeat("?, ", count($fields)), 0, -2));
        $ret["update"]       = sprintf("%s=?", implode("=?, ", $fields));

        // print_pre_r($fields);
        // print_pre_r($this->fields);
        // print_pre_r($ret);
        
        foreach ($fields as $f) {
            $def = $this->definition->getField($f);
            // print_pre_r($def);
            
            if (isset($values[$f])) {
                $ret["values"][] = $values[$f];
            } elseif (isset($def["default"])) {
                $ret["values"][] = $def["default"];
            } else {
                $ret["values"][] = "";
            }
        }

        return $ret;
    }

    
    // public function getCsv()
    // {
    //     $ret = array();

    //     if (count($this->data) > 0) {
    //         $ret["keys"]   = implode(", ", array_keys($this->data));
    //         // $ret["values"] = '"' . implode('", "', array_values($this->data)) . '"';
            
    //         $tmpPdo = str_repeat("?, ", count($this->data));
    //         $tmpPdo = substr($tmpPdo, 0, -2);
            
    //         $ret["pdo"] = sprintf("(%s)", $tmpPdo);
    //     }
        
    //     return $ret;
    // }


    







    
    public function initFields($context)
    {
        $state  = \Loom\System\State::getInstance();
        $config = $state->getConfig();
        $ret    = array();
        
        foreach ($this->definition->getFields() as $key => $val) {

            if (isset($val["opts"]["no" . $context])) {
                continue;
            }

            $ret[$key] = $val;
            $ret[$key]["id"]       = $key;
            $ret[$key]["viewBase"] = $this->get("viewBaseDir") . $context . "/";
            $ret[$key]["viewExt"]  = $this->get("viewExtension");
            $ret[$key]["tpl"]      = sprintf("%s%s%s%s",
                                             $this->get("viewBaseDir"),
                                             $context . "/",
                                             $val["type"],
                                             $this->get("viewExtension"));

            if (isset($val["wrapper"])) {
                $ret[$key]["wrapper"] = sprintf("%s/%s%s",
                                                $config->get("templates.wrapperDir"),
                                                $val["wrapper"],
                                                $config->get("templates.ext"));
            } else {
                $ret[$key]["wrapper"] = $this->getDefaultFieldWrapper();
            }

            if ($this->get($key)) {
                $ret[$key]["value"] = $this->get($key);
            } elseif (isset($val["default"])) {
                $ret[$key]["value"] = $val["default"];
            } elseif ("datepicker" == $val["type"]) {
                $ret[$key]["value"] = date("Y-m-d");
            }
                
        }

        // print_pre_r($ret);
        // die();
        
        $this->fields = $ret;
    }

    public function getFields()
    {
        return $this->fields;
    }

    
    public function setFieldValues($field, array $values)
    {
        if (isset($this->fields[$field])) {
            $this->fields[$field]->setValues($values);
        }
    }


    
    public function setFieldSelected($field, $selected)
    {
        if (isset($this->fields[$field])) {
            $this->fields[$field]->setSelected($selected);
        }
    }


    
    public function getField($field)
    {
        if (isset($this->fields[$field])) {
            // print_pre_r($this->fields[$field]);
            return $this->fields[$field];
        } else {
            return null;
        }
    }

    public function getDefaultFieldWrapper()
    {
        return $this->get("defaultFieldWrapper");
    }

    public function getFieldLabel($field, $key)
    {
        return $this->definition->getFieldLabel($field, $key);
    }

    public function isSelected($field, $key)
    {
        $tmp = $this->get($field);

        if (is_array($tmp) && in_array($key, $tmp)) {
            return true;
        } else {
            return false;
        }
    }

    public function getFieldValue($field)
    {
        return $this->get($field);
    }
    
}
