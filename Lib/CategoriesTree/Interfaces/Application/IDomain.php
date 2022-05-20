<?php

namespace Src\Lib\CategoriesTree\Interfaces\Application;

use Src\Common\Interfaces\Application\IBaseDomain;
use Src\Common\Interfaces\Adapters\ILog;
use Src\Lib\CategoriesTree\Interfaces\Dto\IFactory as IDtoFactory;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IPersistLayer;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IStorage;
use Src\Lib\CategoriesTree\Interfaces\Dto\IResource;

interface IDomain extends IBaseDomain {
    public function setLogAdapter(ILog $adapter):void;
    public function setValidator(IValidator $validator):void;
    public function setDataBuilder(IDataBuilder $builder):void;
    public function setDtoFactory(IDtoFactory $factory):void;
    public function setPersistLayer(IPersistLayer $layer):void;
    public function setStorage(IStorage $storage):void;
    public function createDir(array $data):bool;
    public function renameDir(array $data):bool;
    public function deleteDir(array $data):bool;
    public function getDir():IResource;
}