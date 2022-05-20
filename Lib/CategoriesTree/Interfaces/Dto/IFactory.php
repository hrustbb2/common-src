<?php

namespace Src\Lib\CategoriesTree\Interfaces\Dto;

use Src\Lib\CategoriesTree\Interfaces\IFactory as ILibFactory;

interface IFactory {
    public function init(array $conf = []): void;
    public function setLibFactory(ILibFactory $factory);
    public function createPersist():IPersist;
    public function createResource():IResource;
}