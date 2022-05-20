<?php

namespace Src\Lib\CategoriesTree\Application;

use Src\Lib\CategoriesTree\Interfaces\Application\IFactory;
use Src\Lib\CategoriesTree\Interfaces\IFactory as ILibFactory;
use Src\Lib\CategoriesTree\Interfaces\Application\IDomain;
use Src\Lib\CategoriesTree\Interfaces\Application\IValidator;
use Src\Lib\CategoriesTree\Interfaces\Application\IDataBuilder;

class Factory implements IFactory {

    protected ILibFactory $libFactory;

    protected ?IDomain $domain = null;

    protected array $conf;

    public function init(array $conf = []): void
    {
        $this->conf[IDomain::class] = [
            'class' => Domain::class,
        ];
        $this->conf[IValidator::class] = [
            'class' => Validator::class,
        ];
        $this->conf[IDataBuilder::class] = [
            'class' => DataBuilder::class,
        ];
        array_replace($this->conf, $conf);
    }

    public function setLibFactory(ILibFactory $factory):void
    {
        $this->libFactory = $factory;
    }

    public function getDomain():Domain
    {
        if($this->domain === null){
            $this->domain = new $this->conf[IDomain::class]['class'];
            $logAdapter = $this->libFactory->getCommonFactory()->getAdaptersFactory()->getLog();
            $this->domain->setLogAdapter($logAdapter);
            $validator = $this->createValidator();
            $this->domain->setValidator($validator);
            $dataBuilder = $this->createDataBuilder();
            $this->domain->setDataBuilder($dataBuilder);
            $dtoFactory = $this->libFactory->getDtoFactory();
            $this->domain->setDtoFactory($dtoFactory);
            $persistLayer = $this->libFactory->getInfrastructureFactory()->getPersistLayer();
            $this->domain->setPersistLayer($persistLayer);
            $storage = $this->libFactory->getInfrastructureFactory()->getStorage();
            $this->domain->setStorage($storage);
        }
        return $this->domain;
    }

    public function createValidator():Validator
    {
        return new $this->conf[IValidator::class]['class'];
    }

    public function createDataBuilder():DataBuilder
    {
        $dataBuilder = new $this->conf[IDataBuilder::class]['class'];
        $storage = $this->libFactory->getInfrastructureFactory()->getStorage();
        $dataBuilder->setStorage($storage);
        return $dataBuilder;
    }

}