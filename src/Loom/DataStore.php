<?php

namespace Loom;

interface DataStore
{

    public function connect();
    public function disconnect();
    public function isReady();

}
