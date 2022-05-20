<?php

namespace Src\Lib\CategoriesTree\Infrastructure;

use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IPersistLayer;
use Src\Lib\CategoriesTree\Interfaces\Dto\IPersist;
use Illuminate\Support\Facades\DB;

class PersistLayer implements IPersistLayer {

    protected string $tableName;

    public function setTableName(string $tableName)
    {
        $this->tableName = $tableName;
    }

    public function newDir(IPersist $dto):bool
    {
        $attrs = $dto->getInsertAttributes();
        $qb = DB::table($this->tableName);
        return $qb->insert($attrs);
    }

    public function updateDir(IPersist $dto):int
    {
        $attrs = $dto->getUpdatedAttrs();
        if($attrs){
            $qb = DB::table($this->tableName);
            return $qb->where($this->tableName . '.id', '=', $dto->getId())->update($attrs);
        }
        return 0;
    }

    public function deleteDirs(array $ids):int
    {
        $qb = DB::table($this->tableName);
        return $qb->whereIn($this->tableName . '.id', $ids)->delete();
    }

}