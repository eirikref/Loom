<?php
/**
 * Loom: Database
 * Copyright (c) 2016 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\DataStore;

/**
 * Loom: DataStore\Mysql
 *
 * Simple class for handling database connections with MySQL.
 *
 * @package Loom
 * @version 2016-09-05
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Mysql implements \Loom\DataStore\StorageEngineInterface
{
    
    /**
     * Database handler
     */
    protected $dbh = null;

    /**
     * List of allowed init params
     *
     * @var    array
     * @access protected
     */
    protected $validParams = array("host", "user", "pass", "db");
    protected $config = array();
    protected $error = array();
    protected $isReady = false;


    
    /**
     * Constructor
     */
    public function __construct(array $config = null)
    {
        $this->resetError();

        if ($config) {
            $this->configure($config);
        }
    }


    protected function resetError()
    {
        $this->error = array("code" => null,
                             "msg" => null);
    }

    public function getErrorCode()
    {
        return $this->error["code"];
    }

    public function getErrorMsg()
    {
        if (isset($this->error["msg"][2])) {
            return $this->error["msg"][2];
        }
    }

    /**
     * Configure connection
     */
    public function configure(array $config)
    {
        empty($this->config);

        foreach ($config as $key => $val) {
            if (is_string($key) && in_array($key, $this->validParams)) {
                $this->config[$key] = $val;
            }
        }
    }



    /**
     * Connect
     */
    public function connect()
    {
        $this->resetError();
        $dsn = sprintf("mysql:host=%s;dbname=%s",
                       $this->config["host"], $this->config["db"]);

        try {
            $this->dbh = new \PDO($dsn, $this->config["user"], $this->config["pass"]);
        } catch (\PDOException $e) {
            $this->error["msg"] = $e->getMessage();
            return false;
        }
        
        $this->isReady = true;
        return true;
    }
    


    /**
     * Disconnect
     */
    public function disconnect()
    {
        $this->dbh = null;
        $this->isReady = false;
    }



    /**
     * Query
     */
    public function query($query, array $args = null)
    {
        $this->resetError();
        
        if (!$this->dbh) {
            $this->error["msg"] = "No database connection";
            return false;
        }

        $sth = $this->dbh->prepare($query,array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));

        if (true === $sth->execute($args)) {
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $this->error["code"] = $sth->errorCode();
            $this->error["msg"] = $sth->errorInfo();

            return false;
        }
    }


    public function getLastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    public function isReady()
    {
        return $this->isReady;
    }
}
