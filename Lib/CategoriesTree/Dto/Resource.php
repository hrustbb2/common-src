<?php

namespace Src\Lib\CategoriesTree\Dto;

use Src\Lib\CategoriesTree\Interfaces\Dto\IResource;
use Src\Lib\CategoriesTree\Interfaces\Dto\IFactory as IDtoFactory;

class Resource extends AbstractCategory implements IResource {

    /**
     * @var IDtoFactory
     */
    protected $dtoFactory;

    /**
     * @var IResource
     */
    protected ?AbstractCategory $parent = null;

    /**
     * @var IResource[]
     */
    protected array $path = [];

    public function setDtoFactory(IDtoFactory $factory)
    {
        $this->dtoFactory = $factory;
    }
    
    public function loadPath(array $data)
    {
        $this->path = [];
        foreach($data as $item){
            $pathItem = $this->dtoFactory->createResource();
            $pathItem->load($item);
            $this->path[] = $pathItem;
        }
    }

    public function getPath():array
    {
        return $this->path;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getParent():?IResource
    {
        return $this->parent;
    }

    public function loadParent(array $data)
    {
        $this->parent = $this->dtoFactory->createResource();
        $this->parent->load($data);
    }

    public function toArray(array $fields = []):array
    {
        $result = [];
        if(!$fields){
            $fields = ['id', 'name', 'parent' => ['id', 'name'], 'path' => ['id', 'name']];
        }
        foreach($fields as $key=>$field){
            if($field == 'id'){
                $result['id'] = $this->id;
            }
            if($field == 'name'){
                $result['name'] = $this->name;
            }
            if($key === 'parent' && $this->parent){
                $result['parent'] = $this->parent->toArray($field);
            }
            if($key === 'path'){
                $path = array_map(function(IResource $item) use ($field) {
                    return $item->toArray($field);
                }, $this->path);
                $result['path'] = $path;
            }
        }
        return $result;
    }

}