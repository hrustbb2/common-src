<?php

namespace Src\Common\Interfaces\Dto\Object;

use Src\Common\Dto\Object\AbstractObject;

interface IFactory {
    public function init(array $conf = []): void;
    public function createObjectField(string $type):?AbstractObject;
}