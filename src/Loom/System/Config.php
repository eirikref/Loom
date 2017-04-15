<?php
/**
 * Loom: Config
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\System;

/**
 * Loom: Config
 *
 * @package Loom
 * @version 2017-04-15
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Config extends \Loom\Settable
{

    /**
     * Constructor
     *
     * @static
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2014-07-01
     * @access public
     * @return void
     *
     * @param  array $data Array of data used to populate config object
     */
    public function __construct(array $data = null)
    {
        if (is_array($data) && count($data) > 0) {
            $this->data = $data;
        }
    }

}
