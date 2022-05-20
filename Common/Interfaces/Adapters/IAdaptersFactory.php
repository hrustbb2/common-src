<?php

namespace Src\Common\Interfaces\Adapters;

use Src\Common\Interfaces\Adapters\IAuth;
use Src\Common\Interfaces\Adapters\IHash;
use Src\Common\Interfaces\Adapters\IRoute;
use Src\Common\Interfaces\Adapters\ILog;

interface IAdaptersFactory {
    
    public function init(array $conf = []): void;
    
    public function getAuth():IAuth;

    public function getHash():IHash;

    public function getRoute():IRoute;

    public function getLog():ILog;
}