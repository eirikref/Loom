<?php
/**
 * Loom: Settable
 * Copyright (c) 2013-2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: Settable
 *
 * Class providing a simple interface for setting and getting
 * variables with type-checking.
 *
 * @package Loom
 * @version 2014-05-09
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
     * Max key length
     *
     * @var    integer $maxKeyLength
     * @access private
     */
    private $maxKeyLength = 128;



    /**
     * Set a value
     *
     * 1. Must support multi-level keys
     * 2. Loop through key parts, if they don't exist, create empty array()
     * 3. If on last key part, set value
     * 4. If actual key exists, replace it
     * 5. If non-array key exists and trying to set sub-key, overwrite it
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
        if (!is_string($key) || strlen($key) < 1 || strlen($key) > $this->maxKeyLength) {
            return null;
        }

        // The only place we'll check the value, if type is set. Past
        // this point we accept the value whatever it is.
        if (!is_null($type) && false === $this->checkType($value, $type)) {
            return null;
        }

        // If the delimiter is NOT present in the key, just set the
        // value.
        if (!strstr($key, $this->delimiter)) {
            $this->data[$key] = $value;
            return true;
        }

        // At this point we have a multi-level key, so we need to work
        // our way through the parts of the key and set the value at
        // the appropriate point.
        $subkeys    =  explode($this->delimiter, $key);
        $numSubkeys =  count($subkeys);
        $ptr        =& $this->data;

        for ($i = 0; $i < $numSubkeys; ++$i) {
            $sk     = $subkeys[$i];
            $lastEl = ($i == ($numSubkeys - 1)) ? true : false;

            if (true === $lastEl) {
                $ptr[$sk] = $value;
            } else {
                if (isset($ptr[$sk])) {
                    if (!is_array($ptr[$sk])) {
                        $ptr[$sk] = array();
                    }
                } else {
                    $ptr[$sk] = array();
                }
            }
            
            $ptr =& $ptr[$sk];
        }

        return true;
    }



    /**
     * Get a value
     *
     * TODO: Clean up
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2013-06-20
     * @access public
     * @return mixed 
     *
     * @param  string $key  The variable name
     * @param  string $type Set for strict type checking
     */
    public function get($key = null, $type = null)
    {
        if (is_null($key)) {
            return $this->data;
        } elseif (!is_string($key) || strlen($key) < 1 || strlen($key) > $this->maxKeyLength) {
            return null;
        }

        $return = null;

        if (!strstr($key, $this->delimiter)) {
            if (isset($this->data[$key])) {
                $return = $this->data[$key];
            } else {
                return null;
            }
        } else {
            $subkeys = explode($this->delimiter, $key);
            $tmp     = $this->data;

            foreach ($subkeys as $s) {
                if (is_array($tmp) && isset($tmp[$s])) {
                    $tmp = $tmp[$s];
                } else {
                    return null;
                }
            }
            $return = $tmp;
        }

        if (is_null($type) || $this->checkType($return, $type)) {
            return $return;
        } else {
            return null;
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
        if (!is_string($key) || strlen($key) < 1 || strlen($key) > $this->maxKeyLength) {
            return null;
        }

        if (!$this->get($key)) {
            return null;
        }

        $subkeys    =  explode($this->delimiter, $key);
        $numSubkeys =  count($subkeys);
        $pList[]    =& $this->data;
        $ptr        =& $this->data;

        // Populate the pointer list
        foreach ($subkeys as $s) {
            if (isset($ptr[$s])) {
                $pList[] =& $ptr[$s];
                $ptr     =& $ptr[$s];
            }
        }
        array_pop($pList);
        
        for ($i = sizeof($pList) - 1; $i >= 0; --$i) {
            $sk = $subkeys[$i];

            if (isset($pList[$i][$sk])) {
                unset($pList[$i][$sk]);
            }

            if (count($pList[$i])) {
                break;
            }
        }
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
        if (is_string($delimiter) && 1 == strlen($delimiter)) {
            $this->delimiter = $delimiter;
        }
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

            case 'float':
                if (is_float($value)) {
                    $isValid = true;
                }
                break;

            case 'bool':
            case 'boolean':
                if (is_bool($value)) {
                    $isValid = true;
                }
                break;

            case 'array':
                if (is_array($value)) {
                    $isValid = true;
                }
                break;

            case 'object':
                if (is_object($value)) {
                    $isValid = true;
                }
                break;

        }

        return $isValid;
    }
}
