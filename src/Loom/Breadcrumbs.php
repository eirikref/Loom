<?php
/**
 * Loom: Breadcrumbs
 * Copyright (c) 2016-2017 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: Breadcrumbs
 *
 * Super simple breadcrumbs handler
 *
 * @package Loom
 * @version 2017-04-14
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Breadcrumbs
{

    /**
     * Array containing breadcrumbs data
     *
     * @var    array $data
     * @access protected
     */
    protected $data = array();


    
    /**
     * Set data
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2016-09-12
     * @access public
     * @return void
     *
     * @param  array $in Array of <url, title> pairs
     */
    public function set(array $in)
    {
        $this->reset();
        
        foreach ($in as $key => $val) {
            if (isset($val["url"]) && isset($val["title"])) {
                $this->add($val["url"], $val["title"]);
            }
        }
    }


    
    /**
     * Add single element to breadcrumbs
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2016-09-12
     * @access public
     * @return bool
     *
     * @param  string $url Crumb URL
     * @param  string $title Crumb title
     */
    public function add($url, $title)
    {
        $urlMaxLength   = 4096;
        $titleMaxLength = 100;

        if (!is_string($url) || strlen($url) < 1 || strlen($url) > $urlMaxLength ||
            !is_string($title) || strlen($title) < 1 || strlen($title) > $titleMaxLength) {
            return false;
        }

        $this->data[] = array("url"   => $url,
                              "title" => $title);
        
        return true;
    }

    
    
    /**
     * Get breadcrumbs
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2016-09-12
     * @access public
     * @return array
     */
    public function get()
    {
        return $this->data;
    }


    
    /**
     * Reset/empty list of breadcrumbs
     *
     * @author Eirik Refsdal <eirikref@gmail.com>
     * @since  2016-09-29
     * @access private
     * @return void
     */
    public function reset()
    {
        $this->data = array();
    }
}
