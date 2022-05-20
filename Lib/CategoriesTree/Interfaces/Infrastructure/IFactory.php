<?php

namespace Src\Lib\CategoriesTree\Interfaces\Infrastructure;

use Src\Lib\CategoriesTree\Interfaces\IFactory as ILibFactory;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IStorage;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IPersistLayer;

interface IFactory {
    public function init(array $conf = []): void;
    public function setLibFactory(ILibFactory $factory);
    public function getStorage():IStorage;
    public function getPersistLayer():IPersistLayer;
    public function getMigrations(): IMigrations;
}