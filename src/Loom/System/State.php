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
    protected $breadcrumbs;
    protected $errorHandler;
    protected $errors = array();

    const MOD_CONFIG = "config";
    const MOD_DATASTORE = "datastore";
    const MOD_TEMPLATE = "template";
    const MOD_URL = "url";
    const MOD_ROUTER = "router";
    const MOD_PAGE = "page";
    const MOD_USER = "user";
    const MOD_ERRORHANDLER = "errorhandler";

    
    
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



    public function setErrorHandler(\Loom\ErrorHandler $err)
    {
        $this->errorHandler = $err;
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
        if (isset($this->errors[$this::MOD_CONFIG])) {
            $this->triggerSystemError();
        } else {
            return $this->config;
        }
    }


    
    public function &getDataStore()
    {
        if (isset($this->errors[$this::MOD_DATASTORE])) {
            $this->triggerSystemError();
        } else {
            return $this->dataStore;
        }
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


    
    public function setBreadcrumbs(\Loom\Breadcrumbs $bc)
    {
        $this->breadcrumbs = $bc;
    }


    
    public function &getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }


    
    public function isReady()
    {
        if (count($this->errors) > 0) {
            return false;
        } else {
            return true;
        }
    }


    
    public function addError($module, $code, $msg)
    {
        $this->errors[$module][$code] = $msg;
    }


    
    public function getErrors()
    {
        return $this->errors;
    }


    
    public function triggerSystemError()
    {
        if (isset($this->errorHandler) && $this->errorHandler instanceof \Loom\ErrorHandler) {
            $this->errorHandler->run();
        } else {
            die("Critical error and system error handler is not configured");
        }
    }

}
