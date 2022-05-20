<?php

namespace Src\Lib\CategoriesTree\Dto;

use Src\Lib\CategoriesTree\Interfaces\Dto\IPersist;
use Src\Lib\CategoriesTree\Interfaces\Dto\IFactory as IDtoFactory;

/**
 * @property IPersist $parent
 */
class Persist extends AbstractCategory implements IPersist {

    /**
     * @var IDtoFactory
     */
    protected $dtoFactory;

    protected array $updatedAttrs = [];

    public function init():void
    {
        $this->id = uniqid();
    }

    public function setDtoFactory(IDtoFactory $factory)
    {
        $this->dtoFactory = $factory;
    }

    public function loadPath(array $data)
    {
        $this->path = [];
        foreach($data as $itemData){
            $pathItem = $this->dtoFactory->createPersist();
            $pathItem->load($itemData);
            $this->path[] = $pathItem;
        }
    }

    public function getPath():array
    {
        return $this->path;
    }

    public function loadParent(array $data)
    {
        $this->parent = $this->dtoFactory->createPersist();
        $this->parent->load($data);
    }

    public function update(array $data):void
    {
        if(isset($data['name']) && $data['name'] != $this->name){
            $this->name = $data['name'];
            $this->updatedAttrs['name'] = $data['name'];
        }
    }

    public function getInsertAttributes():array
    {
        $parentId = ($this->parent) ? $this->parent->getId() : '';
        $attrs = [
            'id' => $this->id,
            'parent_id' => $parentId,
            'name' => $this->name,
        ];
        $parentPath = ($this->parent) ? $this->parent->getPath() : [];
        $pathIds = array_map(function(AbstractCategory $item){
            return $item->getId();
        }, $parentPath);
        $pathIds[] = $parentId;
        $attrs['matherial_path'] = join('|', $pathIds);
        return $attrs;
    }

    public function getUpdatedAttrs():array
    {
        return $this->updatedAttrs;
    }

}