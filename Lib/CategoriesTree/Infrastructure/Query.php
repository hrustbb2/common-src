<?php

namespace Src\Lib\CategoriesTree\Infrastructure;

use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IQuery;
use Src\Common\Infrastructure\TraitSqlQuery;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use hrustbb2\arrayproc\ArrayProcessor;

class Query implements IQuery {

    use TraitSqlQuery {
        TraitSqlQuery::getSelectSection as baseGetSelectSection;
    }

    protected string $tableName;

    protected Builder $queryBuilder;

    protected array $arrayProcConf = [];

    protected bool $isParentJoined = false;

    public function setTableName(string $tableName)
    {
        $this->tableName = $tableName;
    }

    protected function reset()
    {
        $this->queryBuilder = DB::table($this->tableName);
        $this->isParentJoined = false;
    }

    protected function getSelectSection(array $fields, array $allowFields, string $table, string $prefix = ''): array
    {
        $segments = $this->baseGetSelectSection($fields, $allowFields, $table, $prefix);
        $result = [];
        foreach($segments as $field=>$alias){
            $result[] = $field . ' AS ' . $alias;
        }
        return $result;
    }

    public function select(array $fields)
    {
        $this->reset();
        $selectSection = $this->getSelectSection($fields, ['id', 'matherial_path', 'parent_id', 'name'], $this->tableName, 'category_');
        $this->queryBuilder->select($selectSection);
        $this->arrayProcConf = ['prefix' => 'category_'];
        return $this;
    }

    public function whereId($id)
    {
        $this->queryBuilder->where($this->tableName . '.id', '=', $id);
        return $this;
    }

    public function whereIdIn(array $ids)
    {
        $this->queryBuilder->whereIn($this->tableName . '.id', $ids);
        return $this;
    }

    public function whereParentId($parentId)
    {
        $this->queryBuilder->where($this->tableName . '.parent_id', '=', $parentId);
        return $this;
    }

    public function whereInPath(string $matherialPath)
    {
        $this->queryBuilder->where($this->tableName . '.matherial_path', 'like', $matherialPath . '%');
        return $this;
    }

    public function withParent(array $fields)
    {
        $this->joinParend();
        $selectSection = $this->getSelectSection($fields, ['id', 'matherial_path', 'parent_id', 'name'], $this->tableName, 'parent_');
        $this->queryBuilder->addSelect($selectSection);
        $this->arrayProcConf['parent'] = ['prefix' => 'parent_'];
        return $this;
    }

    protected function joinParend()
    {
        if(!$this->isParentJoined){
            $first = $this->tableName . '.id';
            $two = $this->tableName . '.parent_id';
            $this->queryBuilder->leftJoin($this->tableName . ' AS parent', $first, '=', $two);
            $this->isParentJoined = true;
        }
    }

    public function all(): array
    {
        $arrayProc = new ArrayProcessor();
        $data = $this->queryBuilder->get()->toArray();
        return $arrayProc->process($this->arrayProcConf, $data)->resultArray();
    }

    public function one(): array
    {
        $arrayProc = new ArrayProcessor();
        $data = $this->queryBuilder->get()->toArray();
        $d = $arrayProc->process($this->arrayProcConf, $data)->resultArray();
        return array_pop($d) ?? [];
    }

}