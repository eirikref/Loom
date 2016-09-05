<?php
/*
 * Loom: System State
 */

namespace Loom\System;

class State
{

    protected $config;
    protected $template;
    protected $url;
    protected $router;
    protected $page;
    protected $user;

    public function setConfig($config instanceof \Loom\System\Config)
    {
        $this->config = $config;
    }

    public function setTemplate($template instanceof \Loom\Template)
    {
        $this->template = $template;
    }

    public function setUrl($url instanceof \Loom\Url)
    {
        $this->url = $url;
    }

    public function setRouter($router instanceof \Loom\Router)
    {
        $this->router = $router;
    }

    public function setPage($page instanceof \Loom\System\Page)
    {
        $this->page = $page;
    }

    public function setUser($user instanceof \Loom\User)
    {
        $this->user = $user;
    }

    public function &getConfig()
    {
        return $this->config;
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
