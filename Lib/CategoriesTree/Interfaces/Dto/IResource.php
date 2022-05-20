<?php

namespace Src\Lib\CategoriesTree\Interfaces\Dto;

use Src\Lib\CategoriesTree\Interfaces\Dto\IFactory as IDtoFactory;

interface IResource extends IAbstractCategory {
    public function setDtoFactory(IDtoFactory $factory);
    public function toArray(array $fields = []):array;
    /**
     * @return IResource[]
     */
    public function getPath():array;
    public function getName():string;
    public function getParent():?IResource;
}