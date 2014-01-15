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
     * 1. Must support multi-level keys
     * 2. Loop through key parts, if they don't exist, create empty array()
     * 3. If on last key part, set value
     * 4. If actual key exists, replace it
     * 5. If non-array key exists and trying to set sub-key, convert to array?
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
        if (!is_string($key) || strlen($key) < 1) {
            return false;
        }

        if (!is_null($type) && false === $this->checkType($value, $type)) {
            return false;
        }

        $keys    =  explode($this->delimeter, $key);
        $numKeys =  count($keys);
        $ptr     =& $this->data;

        for ($i = 0; $i < $numKeys; ++$i) {
            $key    = $keys[$i];
            $lastEl = ($i == ($numKeys - 1)) ? true : false;

            if (true === $lastEl) {
                $ptr[$key] = $value;
            } else {
                if (isset($ptr[$key])) {
                    // Ignore for now
                } else {
                    $ptr[$key] = array();
                }
            }
            
            $ptr =& $ptr[$key];
        }

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
    private function checkType($value, $type)
    {
        $isValid = false;

        if (!is_string($type)) {
            return false;
        }

        switch ($type) {
        case 'string':
            if (is_string($value)) {
                $isValid = true;
            }
            break;

        case 'digit':
            if (is_int($value) || is_string($value)) {
                if (ctype_digit((string)$value)) {
                    $isValid = true;
                }
            }
            break;
            
        case 'int':
            if (is_int($value)) {
                $isValid = true;
            }
            break;

        case 'bool':
        case 'boolean':
            if (is_bool($value)) {
                $isValid = true;
            }
            break;
        }

        return $isValid;
    }
}
