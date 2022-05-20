<?php

namespace Src\Common\Interfaces\Adapters;

use Src\Common\Interfaces\Adapters\IAdaptersFactory;

interface IFactory {
    
    public function init(array $conf = []): void;
    
    /**
     * @return IAdaptersFactory
     */
    public function getAdaptersFactory(string $name);
}