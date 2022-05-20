<?php

namespace Src\Lib\CategoriesTree\Interfaces\Application;

use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IStorage;

interface IDataBuilder {
    public function setStorage(IStorage $storage):void;
    public function buildData(array $requestData):array;
}