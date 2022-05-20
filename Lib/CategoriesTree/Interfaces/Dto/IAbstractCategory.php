<?php

namespace Src\Lib\CategoriesTree\Interfaces\Dto;

interface IAbstractCategory {
    public function getId();
    public function load(array $data);
    public function loadPath(array $data);
    public function loadParent(array $data);
    public function getAttributes();
}