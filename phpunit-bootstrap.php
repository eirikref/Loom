<?php

$autoloader = "./vendor/autoload.php";

if (file_exists($autoloader)) {
    require_once $autoloader;
} else {
    die("Please run 'composer install' first\n");
}
