<?php

namespace Src\Lib\CategoriesTree\Dto;

use Src\Lib\CategoriesTree\Interfaces\Dto\IFactory;
use Src\Lib\CategoriesTree\Interfaces\IFactory as ILibFactory;
use Src\Lib\CategoriesTree\Interfaces\Dto\IPersist;
use Src\Lib\CategoriesTree\Interfaces\Dto\IResource;

class Factory implements IFactory {

    protected ILibFactory $libFactory;

    protected array $conf;

    public function init(array $conf = []): void
    {
        $this->conf[IPersist::class] = [
            'class' => Persist::class,
        ];
        $this->conf[IResource::class] = [
            'class' => Resource::class,
        ];
        array_replace($this->conf, $conf);
    }

    public function setLibFactory(ILibFactory $factory)
    {
        $this->libFactory = $factory;
    }

    public function createPersist():IPersist
    {
        $persist = new $this->conf[IPersist::class]['class'];
        $persist->setDtoFactory($this);
        $persist->init();
        return $persist;
    }

    public function createResource():IResource
    {
        $resource = new $this->conf[IResource::class]['class'];
        $resource->setDtoFactory($this);
        return $resource;
    }

}