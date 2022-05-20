<?php

namespace Src\Common\Adapters;

use Src\Common\Interfaces\Adapters\IFactory;
use Src\Common\Interfaces\Adapters\IAdaptersFactory;
use Src\Common\Adapters\Laravel\Factory as LaravelFactory;

class Factory implements IFactory {

    protected ?IAdaptersFactory $adaptersFactory = null;

    protected array $conf;

    public function init(array $conf = []): void
    {
        $this->conf[LaravelFactory::class] = [
            'class' => LaravelFactory::class,
            'conf' => [],
        ];
        $this->conf = array_replace_recursive($this->conf, $conf);
    }
    
    public function getAdaptersFactory(string $name)
    {
        if($this->adaptersFactory === null){
            $this->adaptersFactory = new $this->conf[LaravelFactory::class]['class'];
            $this->adaptersFactory->init($this->conf[LaravelFactory::class]['conf']);
        }
        return $this->adaptersFactory;
    }

}