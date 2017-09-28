<?php

namespace Loom;

class DataStore
{

    private $backend;
    private $catalog;


    
    public function __construct(\Loom\DataStore\StorageEngineInterface $backend)
    {
        $this->backend = $backend;
        $this->catalog = new \Loom\Settable();
    }


    
    public function connect()
    {
        return $this->backend->connect();
    }


    
    public function disconnect()
    {
        return $this->backend->disconnect();
    }


    
    public function register($ns, \Loom\DataStore\QueryGroup $res)
    {
        $res->setParent($this);
        $this->catalog->set($ns, $res);
    }


    
    public function query($id, array $payload = null)
    {
        if (!strrpos($id, ".")) {
            return false;
        }

        $ns     = substr($id, 0, strrpos($id, "."));
        $method = substr($id, strrpos($id, ".") + 1);

        if ($this->catalog->has($ns) && method_exists($this->catalog->get($ns), $method)) {
            return $this->catalog->get($ns)->{$method}($payload);
        } else {
            error_log("Invalid DataStore method: $ns::$method");
            $this->getCatalog();
        }
    }



    private function preparePdo()
    {
        if (count($this->data) > 0) {
            $ret["keys"]   = implode(", ", array_keys($this->data));
            $ret["values"] = '"' . implode('", "', array_values($this->data)) . '"';
            
            $tmpPdo = str_repeat("?, ", count($this->data));
            $tmpPdo = substr($tmpPdo, 0, -2);
            
            $ret["pdo"] = sprintf("(%s)", $tmpPdo);
        }
    }


    
    public function queryBackend($query, array $args = null)
    {
        return $this->backend->query($query, $args);
    }
}
