<?php

namespace Loom\DataStore;

interface StorageEngineInterface
{

    public function connect();
    public function disconnect();
    public function isReady();
    public function query($query, array $args = null);
}
