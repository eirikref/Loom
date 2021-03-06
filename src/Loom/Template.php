<?php

namespace Loom;

class Template
{

    public function __construct(array $config)
    {
        if (!($this->validateConfig($config))) {
            return;
        }

        $templateDir = $config["templateDir"];
        
        require_once "vendor/twig/twig/lib/Twig/Autoloader.php";
        \Twig_Autoloader::register();

        $this->loader = new \Twig_Loader_Filesystem($templateDir);
        $this->twig = new \Twig_Environment($this->loader, array(
            // "cache" => "/Users/eirikref/projects/contentmagic/var/cache",
        ));
    }


    
    private function validateConfig(array $config)
    {
        if (!(isset($config["templateDir"]))) {
            return false;
        }

        if (!(is_string($config["templateDir"]) || is_array($config["templateDir"]))) {
            return false;
        }

        return true;
    }


    
    public function fetch($tpl, array $args = null)
    {
        $state = \Loom\System\State::getInstance();
        $args["state"] = $state;
        $args["user"]  = $state->getUser();

        $html = $this->twig->render($tpl, $args);
        return $html;
    }



    public function render($tpl, array $args = null)
    {
        $html = $this->fetch($tpl, $args);
        print $html;
    }


    
    public function addPath($path)
    {
        $this->loader->addPath($path);
    }
}
