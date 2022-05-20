<?php

namespace Src\Lib\CategoriesTree\Interfaces\Application;

use Src\Lib\CategoriesTree\Interfaces\IFactory as ILibFactory;
use Src\Lib\CategoriesTree\Interfaces\Application\IDomain;
use Src\Lib\CategoriesTree\Interfaces\Application\IValidator;

interface IFactory {
    public function init(array $conf = []): void;
    public function setLibFactory(ILibFactory $factory):void;
    public function getDomain():IDomain;
    public function createValidator():IValidator;
    public function createDataBuilder():IDataBuilder;
}