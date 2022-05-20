<?php

namespace Src\Lib\CategoriesTree\Infrastructure;

use Src\Lib\CategoriesTree\Dto\Persist;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IFactory;
use Src\Lib\CategoriesTree\Interfaces\IFactory as ILibFactory;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IStorage;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IQuery;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IPersistLayer;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IMigrations;

class Factory implements IFactory {

    protected ILibFactory $libFactory;

    protected ?IStorage $storage = null;

    protected ?IPersistLayer $persistLayer = null;

    protected ?IMigrations $migration = null;

    protected array $conf;

    public function init(array $conf = []): void
    {
        $this->conf[IQuery::class] = [
            'class' => Query::class,
        ];
        $this->conf[IStorage::class] = [
            'class' => Storage::class,
        ];
        $this->conf[IPersistLayer::class] = [
            'class' => PersistLayer::class,
        ];
        array_replace($this->conf, $conf);
    }

    public function setLibFactory(ILibFactory $factory)
    {
        $this->libFactory = $factory;
    }

    protected function createQuery(): Query
    {
        $query = new $this->conf[IQuery::class]['class'];
        $tableName = $this->libFactory->getSetting(ILibFactory::TABLE_NAME);
        $query->setTableName($tableName);
        return $query;
    }

    public function getStorage():IStorage
    {
        if($this->storage === null){
            $this->storage = new $this->conf[IStorage::class]['class'];
            $query = $this->createQuery();
            $this->storage->setQuery($query);
        }
        return $this->storage;
    }

    public function getPersistLayer():IPersistLayer
    {
        if($this->persistLayer === null){
            $this->persistLayer = new $this->conf[IPersistLayer::class]['class'];
            $tableName = $this->libFactory->getSetting(ILibFactory::TABLE_NAME);
            $this->persistLayer->setTableName($tableName);
        }
        return $this->persistLayer;
    }

    public function getMigrations(): Migrations
    {
        if($this->migration === null){
            $this->migration = new Migrations();
            $settings = $this->libFactory->getSettings();
            $this->migration->init($settings);
        }
        return $this->migration;
    }

}