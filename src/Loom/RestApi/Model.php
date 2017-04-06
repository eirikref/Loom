<?php
/**
 * Loom: RestApi/OpenApi
 * Copyright (c) 2016 Eirik Refsdal <eirikref@gmail.com>
 */

namespace Loom\RestApi;

/**
 * Loom: RestApi Model interface
 *
 * Interface for API models
 *
 * @package Loom
 * @version 2016-10-20
 * @author  Eirik Refsdal <eirikref@gmail.com>
 */
interface Model
{

    public function getResource($path);
    public function getBasePath();
    public function getResources();
    public function addPaths(array $paths);
    public function addDefinitions(array $defs);
}
