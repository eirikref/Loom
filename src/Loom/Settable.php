<?php
/**
 * Loom: Settable
 * Copyright (c) 2013 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: Settable
 *
 * Class providing a simple interface for setting and getting
 * variables with type-checking.
 *
 * @package Loom
 * @version 2013-06-20
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Settable
{

    /**
     * Array containing data
     *
     * @var    array $data
     * @access private
     */
    private $data = array();

    /**
     * Delimiter for supporting multi-level keys, ie. "config.db.mysql.host"
     *
     * @var    string $delimiter
     * @access private
     */
    private $delimiter = ".";



    /**
     * Set a value
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-20
     * @access public
     * @return boolean True if able to set, false if not
     *
     * @param  string $key   The variable name
     * @param  mixed  $value The value
     * @param  string $type  Set for strict type checking
     */
    public function set($key, $value, $type = null)
    {
        $this->data[$key] = $value;

        return true;
    }



    /**
     * Get a value
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-20
     * @access public
     * @return mixed 
     *
     * @param  string $key  The variable name
     * @param  string $type Set for strict type checking
     */
    public function get($key, $type = null)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }
    }



    /**
     * Remove a value
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-20
     * @access public
     * @return object $this
     *
     * @param  string $key The variable name
     */
    public function remove($key)
    {
    }



    /**
     * Set delimiter for multi-level keys
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-20
     * @access public
     * @return object $this
     *
     * @param  string $delimiter The delimiter
     */
    public function setDelimiter($delimiter)
    {
    }



    /**
     * Checks if the given value matches the given type, ie. if an
     * integer actually is an integer.
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-20
     * @access private
     * @return boolean
     *
     * @param  mixed  $value The value
     * @param  string $type  The required type
     */
    private function checkType($item, $type)
    {
    }
}
