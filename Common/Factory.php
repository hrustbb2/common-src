<?php

namespace Src\Common;

use Src\Common\Interfaces\IFactory;
use Src\Common\Interfaces\Pages\IFactory as IPagesFactory;
use Src\Common\Pages\Factory as PagesFactory;
use Src\Common\Interfaces\Adapters\IAdaptersFactory;
use Src\Common\Adapters\Factory as Adapters;
use Src\Common\Interfaces\Dto\IFactory as IDtoFactory;
use Src\Common\Dto\Factory as DtoFactory;
use Src\Common\Interfaces\Application\IFilesBrowser;
use Src\Common\Application\FilesBrowser;

class Factory implements IFactory {
    
    protected string $frameworkName;

    protected array $conf;

    /**
     * @var IPagesFactory
     */
    protected ?IPagesFactory $pagesFactory = null;

    protected ?IAdaptersFactory $adaptersFactory = null;

    protected ?IDtoFactory $dtoFactory = null;

    protected ?IFilesBrowser $filesBrowser = null;

    public function setFrameworkName(string $name):void
    {
        $this->frameworkName = $name;
    }

    public function init(array $conf = []): void
    {
        $this->conf[IPagesFactory::class] = [
            'class' => PagesFactory::class,
            'conf' => [],
        ];
        $this->conf[Adapters::class] = [
            'class' => Adapters::class,
            'conf' => [],
        ];
        $this->conf[IDtoFactory::class] = [
            'class' => DtoFactory::class,
            'conf' => [],
        ];
        $this->conf[IFilesBrowser::class] = [
            'class' => FilesBrowser::class,
            'conf' => [],
        ];
        $this->conf = array_replace_recursive($this->conf, $conf);
    }

    public function getPagesFactory():PagesFactory
    {
        if($this->pagesFactory === null){
            $this->pagesFactory = new $this->conf[IPagesFactory::class]['class'];
            $this->pagesFactory->init($this->conf[IPagesFactory::class]['conf']);
        }
        return $this->pagesFactory;
    }

    public function getAdaptersFactory():IAdaptersFactory
    {
        if($this->adaptersFactory === null){
            $adapters = new $this->conf[Adapters::class]['class'];
            $adapters->init($this->conf[Adapters::class]['conf']);
            $this->adaptersFactory = $adapters->getAdaptersFactory($this->frameworkName);
        }
        return $this->adaptersFactory;
    }

    public function getDtoFactory():DtoFactory
    {
        if($this->dtoFactory === null){
            $this->dtoFactory = new $this->conf[IDtoFactory::class]['class'];
            $this->dtoFactory->init($this->conf[IDtoFactory::class]['conf']);
        }
        return $this->dtoFactory;
    }

    public function getFilesBrowser():FilesBrowser
    {
        if($this->filesBrowser === null){
            $this->filesBrowser = new $this->conf[IFilesBrowser::class]['class'];
            $this->filesBrowser->init($this->conf[IFilesBrowser::class]['conf']);
        }
        return $this->filesBrowser;
    }

}