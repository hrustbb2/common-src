<?php

namespace Src\Common\Adapters\Laravel;

use Src\Common\Interfaces\Adapters\IAdaptersFactory;
use Src\Common\Interfaces\Adapters\IAuth;
use Src\Common\Adapters\Laravel\Auth;
use Src\Common\Interfaces\Adapters\IHash;
use Src\Common\Adapters\Laravel\Hash;
use Src\Common\Interfaces\Adapters\IRoute;
use Src\Common\Adapters\Laravel\Route;
use Src\Common\Interfaces\Adapters\ILog;
use Src\Common\Adapters\Laravel\Log;

class Factory implements IAdaptersFactory {

    protected ?IAuth $auth = null;

    protected ?IHash $hash = null;

    protected ?IRoute $route = null;

    protected ?ILog $log = null;

    protected array $conf;

    public function init(array $conf = []): void
    {
        
    }

    public function getAuth():IAuth
    {
        if($this->auth === null){
            $this->auth = new Auth();
        }
        return $this->auth;
    }

    public function getHash():IHash
    {
        if($this->hash === null){
            $this->hash = new Hash();
        }
        return $this->hash;
    }

    public function getRoute():IRoute
    {
        if($this->route === null){
            $this->route = new Route();
        }
        return $this->route;
    }

    public function getLog():ILog
    {
        if($this->log === null){
            $this->log = new Log();
        }
        return $this->log;
    }

}