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
    protected $params = array("host", "user", "pass", "db");



    /**
     * Constructor
     */
    public function __construct()
    {
    }



    /**
     * Configure connection
     */
    public function configure()
    {
    }



    /**
     * Connect
     */
    public function connect()
    {
    }



    /**
     * Disconnect
     */
    public function disconnect()
    {
    }



    /**
     * Query
     */
    public function query()
    {
    }

}
