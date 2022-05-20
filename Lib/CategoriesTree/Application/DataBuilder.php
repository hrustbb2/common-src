<?php

namespace Src\Lib\CategoriesTree\Application;

use Src\Lib\CategoriesTree\Interfaces\Application\IDataBuilder;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IStorage;

class DataBuilder implements IDataBuilder {

    protected IStorage $storage;

    public function setStorage(IStorage $storage):void
    {
        $this->storage = $storage;
    }

    public function buildData(array $requestData):array
    {
        $dsl = [
            'id', 'matherial_path',
            'path' => ['id']
        ];
        $parentData = $this->storage->getById($requestData['parent-dir'], $dsl);
        if($parentData){
            $requestData['parent'] = [
                $parentData['id'] => $parentData,
            ];
        }
        return $requestData;
    }

}