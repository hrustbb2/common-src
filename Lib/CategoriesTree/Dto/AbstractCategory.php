<?php

namespace Src\Lib\CategoriesTree\Dto;

abstract class AbstractCategory {

    protected $id;

    protected array $path = [];

    protected ?AbstractCategory $parent = null;

    protected string $name;

    public function getId()
    {
        return $this->id;
    }

    public function load(array $data)
    {
        $this->id = $data['id'] ?? $this->id;
        $this->name = $data['name'] ?? '';
        if(key_exists('path', $data)){
            $this->loadPath($data['path']);
        }
        if(key_exists('parent', $data)){
            $parentData = array_pop($data['parent']);
            $this->loadParent($parentData);
        }
    }

    abstract public function loadPath(array $data);

    abstract public function loadParent(array $data);

    public function getAttributes()
    {
        $attrs = [
            'id' => $this->id,
            'name' => $this->name,
        ];
        $path = array_map(function(AbstractCategory $pathItem){
            return $pathItem->getAttributes();
        }, $this->path);
        $attrs['path'] = $path;
        if($this->parent){
            $parentAttrs = $this->parent->getAttributes();
            $attrs['parent'] = [
                $this->parent->getId() => $parentAttrs,
            ];
        }
        return $attrs;
    }

}