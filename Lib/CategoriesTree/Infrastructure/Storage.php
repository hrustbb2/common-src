<?php

namespace Src\Lib\CategoriesTree\Infrastructure;

use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IStorage;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IQuery;
use Src\Common\Infrastructure\TraitStorage;

class Storage implements IStorage {

    use TraitStorage;
    
    protected IQuery $query;

    public function setQuery(IQuery $query)
    {
        $this->query = $query;
    }

    public function getById($id, array $dsl = []):array
    {
        $this->query->select($dsl)->whereId($id);
        if(key_exists('parent', $dsl)){
            $this->query->withParent($dsl['parent']);
        }
        $data = $this->query->one();
        if(key_exists('path', $dsl) && isset($data['matherial_path'])){
            $ids = explode('|', $data['matherial_path']);
            $path = $this->query->select($dsl['path'])->whereIdIn($ids)->all();
            $data['path'] = $path;
        }
        return $data;
    }

    public function getByParentId($parentId, array $dsl = []):array
    {
        return $this->query->select($dsl)->whereParentId($parentId)->all();
    }

    public function getIdsInDir(string $dirId):array
    {
        $dirData = $this->query->select(['id', 'matherial_path'])->whereId($dirId)->one();
        $pathIds = ($dirData['matherial_path']) ? explode('|', $dirData['matherial_path']) : [];
        $pathIds[] = $dirId;
        $matherialPath = join('|', $pathIds);
        $dirs = $this->query->select(['id'])->whereInPath($matherialPath)->all();
        $ids = array_map(function($dir){
            return $dir['id'];
        }, $dirs);
        return array_values($ids);
    }

}