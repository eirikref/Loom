<?php
/**
 * Loom: Config
 * Copyright (c) 2014 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom;

/**
 * Loom: Config
 *
 * Class containing any kind of configuration
 *
 * @package Loom
 * @version 2014-05-06
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
class Config
{

    private $ready = true;

    public function __construct($file = null)
    {
        if ($file) {
            $this->ready = false;
            $this->read($file);
        }
    }

    private function read($in)
    {
        $file = null;

        if ($in instanceof \Loom\File) {
            $file = $in;
        } elseif (is_string($in)) {
            $file = new \Loom\File($in);
        }

        if (!(isset($file) && $file->isReadable())) {
            // handle something
            // Log error
            return false;
        }

        switch ($file->getExtension()) {
        case 'yaml':
            $this->readYaml($file);
            break;

        case 'ini':
            $this->readIni($file);
            break;

        default:
            break;
        }
    }

    private function isReady()
    {
        return $this->ready;
    }

}
