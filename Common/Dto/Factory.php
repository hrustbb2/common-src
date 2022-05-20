<?php

namespace Src\Common\Dto;

use Src\Common\Interfaces\Dto\IFactory;
use Src\Common\Interfaces\Dto\Object\IFactory as IObjectFactory;
use Src\Common\Dto\Object\Factory as ObjectFactory;

class Factory implements IFactory {
    
    protected ?IObjectFactory $objectFactory = null;

    protected array $conf;

    public function init(array $conf = []): void
    {
        $this->conf[IObjectFactory::class] = [
            'class' => ObjectFactory::class,
            'conf' => [],
        ];
        array_replace($this->conf, $conf);
    }

    public function getObjectFactory(): IObjectFactory
    {
        if($this->objectFactory === null){
            $this->objectFactory = new $this->conf[IObjectFactory::class]['class'];
            $this->objectFactory->init($this->conf[IObjectFactory::class]['conf']);
        }
        return $this->objectFactory;
    }

}