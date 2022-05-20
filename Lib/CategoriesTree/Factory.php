<?php

namespace Src\Lib\CategoriesTree;

use Src\Lib\CategoriesTree\Interfaces\IFactory;
use Src\Common\Interfaces\IFactory as ICommonFactory;
use Src\Lib\CategoriesTree\Interfaces\Dto\IFactory as IDtoFactory;
use Src\Lib\CategoriesTree\Dto\Factory as DtoFactory;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IFactory as IInfrastructureFactory;
use Src\Lib\CategoriesTree\Infrastructure\Factory as InfrastructureFactory;
use Src\Lib\CategoriesTree\Interfaces\Application\IFactory as IApplicationFactory;
use Src\Lib\CategoriesTree\Application\Factory as ApplicationFactory;

class Factory implements IFactory {

    protected ICommonFactory $commonFactory;

    protected ?IDtoFactory $dtoFactory = null;

    protected ?IInfrastructureFactory $infrastructureFactory = null;

    protected ?IApplicationFactory $applicationFactory = null;

    protected array $settings;

    protected array $conf;

    public function init(array $conf = []): void
    {
        $this->conf[IDtoFactory::class] = [
            'class' => DtoFactory::class,
            'conf' => [],
        ];
        $this->conf[IInfrastructureFactory::class] = [
            'class' => InfrastructureFactory::class,
            'conf' => [],
        ];
        $this->conf[IApplicationFactory::class] = [
            'class' => ApplicationFactory::class,
            'conf' => [],
        ];
        array_replace($this->conf, $conf);
    }

    public function setCommonFactory(ICommonFactory $factory)
    {
        $this->commonFactory = $factory;
    }

    public function getCommonFactory():ICommonFactory
    {
        return $this->commonFactory;
    }
    
    public function loadSettings(array $settings)
    {
        $this->settings = $settings;
    }

    public function getSetting(string $key)
    {
        return $this->settings[$key];
    }

    public function getSettings(): array
    {
        return $this->settings;
    }
    
    public function getDtoFactory():DtoFactory
    {
        if($this->dtoFactory === null){
            $conf = $this->conf[IDtoFactory::class];
            $this->dtoFactory = new $conf['class'];
            $this->dtoFactory->init($conf['conf']);
            $this->dtoFactory->setLibFactory($this);
        }
        return $this->dtoFactory;
    }

    public function getInfrastructureFactory():InfrastructureFactory
    {
        if($this->infrastructureFactory === null){
            $conf = $this->conf[IInfrastructureFactory::class];
            $this->infrastructureFactory = new $conf['class'];
            $this->infrastructureFactory->init($conf['conf']);
            $this->infrastructureFactory->setLibFactory($this);
        }
        return $this->infrastructureFactory;
    }

    public function getApplicationFactory():ApplicationFactory
    {
        if($this->applicationFactory === null){
            $conf = $this->conf[IApplicationFactory::class];
            $this->applicationFactory = new $conf['class'];
            $this->applicationFactory->init($conf['conf']);
            $this->applicationFactory->setLibFactory($this);
        }
        return $this->applicationFactory;
    }

}