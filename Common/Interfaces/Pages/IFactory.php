<?php

namespace Src\Common\Interfaces\Pages;

use Src\Common\Interfaces\Pages\Sidebar\IFactory as ISidebarFactory;

interface IFactory {

    public function init(array $conf = []): void;
    
    public function getSidebarFactory(): ISidebarFactory;
}