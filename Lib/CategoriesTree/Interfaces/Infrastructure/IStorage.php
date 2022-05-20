<?php

namespace Src\Lib\CategoriesTree\Interfaces\Infrastructure;

use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IQuery;

interface IStorage {
    public function setQuery(IQuery $query);
    public function getById($id, array $dsl = []):array;
    public function getByParentId($parentId, array $dsl = []):array;
    public function getIdsInDir(string $materialPath):array;
}