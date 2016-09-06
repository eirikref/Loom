<?php

namespace Loom;

class Template
{

    // /**
    //  * The singleton instance of this class
    //  *
    //  * @var    object $instance
    //  * @access protected
    //  */
    // protected static $instance = null;

    // public static function &getInstance()
    // {
    //     if (null === self::$instance) {
    //         self::$instance = new Template();
    //     }

    //     return self::$instance;
    // }

    
    public function __construct()
    {
        require_once "vendor/twig/twig/lib/Twig/Autoloader.php";
        \Twig_Autoloader::register();
        
        $this->loader = new \Twig_Loader_Filesystem("/Users/eirikref/projects/contentmagic/src/templates");
        $this->twig = new \Twig_Environment($this->loader, array(
            // "cache" => "/Users/eirikref/projects/contentmagic/var/cache",
        ));
    }

    public function render($tpl, array $args = null)
    {
        $state = \Loom\System\State::getInstance();
        $args["state"] = $state;
        $args["user"]  = $state->getUser();
        
        $html = $this->twig->render($tpl, $args);
        print $html;
    }
}
