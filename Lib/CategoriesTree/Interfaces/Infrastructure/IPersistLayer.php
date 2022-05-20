<?php

namespace Src\Lib\CategoriesTree\Interfaces\Infrastructure;

use Src\Lib\CategoriesTree\Interfaces\Dto\IPersist;

interface IPersistLayer {
    public function setTableName(string $tableName);
    public function newDir(IPersist $dto):bool;
    public function updateDir(IPersist $dto):int;
    public function deleteDirs(array $ids):int;
}