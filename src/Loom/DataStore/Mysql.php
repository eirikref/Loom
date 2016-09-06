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
class Mysql implements \Loom\DataStore
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


    /**
     * Constructor
     */
    public function __construct()
    {
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
        $dsn = sprintf("mysql:host=%s;dbname=%s",
                       $this->config["host"], $this->config["db"]);

        try {
            $this->dbh = new \PDO($dsn, $this->config["user"], $this->config["pass"]);
        } catch (\PDOException $e) {
            echo "error error: " . $e->getMessage();
        }
        
    }
    


    /**
     * Disconnect
     */
    public function disconnect()
    {
        $this->dbh = null;
    }



    /**
     * Query
     */
    public function query($query, $args)
    {
        if (!$this->dbh) {
            return false;
        }

        $sth = $this->dbh->prepare($query, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
        $sth->execute($args);

        // var_dump($sth->errorInfo());
        
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

}
