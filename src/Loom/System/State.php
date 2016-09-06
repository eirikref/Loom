<?php
/*
 * Loom: System State
 */

namespace Loom\System;

class State
{

    protected static $instance;
    protected $config;
    protected $dataStore;
    protected $template;
    protected $url;
    protected $router;
    protected $page;
    protected $user;

    private function __construct()
    {
    }
    
    public static function &getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new \Loom\System\State();
        }
        
        return self::$instance;
    }

    public function setConfig(\Loom\System\Config $config)
    {
        $this->config = $config;
    }

    public function setDataStore(\Loom\DataStore $dataStore)
    {
        $this->dataStore = $dataStore;
    }

    public function setTemplate(\Loom\Template $template)
    {
        $this->template = $template;
    }

    public function setUrl(\Loom\Url $url)
    {
        $this->url = $url;
    }

    public function setRouter(\Loom\Router $router)
    {
        $this->router = $router;
    }

    public function setPage(\Loom\System\Page $page)
    {
        $this->page = $page;
    }

    public function setUser(\Loom\User $user)
    {
        $this->user = $user;
    }

    public function &getConfig()
    {
        return $this->config;
    }

    public function &getDataStore()
    {
        return $this->dataStore;
    }

    public function &getTemplate()
    {
        return $this->template;
    }

    public function &getUrl()
    {
        return $this->url;
    }

    public function &getRouter()
    {
        return $this->router;
    }

    public function &getPage()
    {
        return $this->page;
    }

    public function &getUser()
    {
        return $this->user;
    }

}
