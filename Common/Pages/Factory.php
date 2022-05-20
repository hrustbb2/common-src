<?php

namespace Src\Common\Pages;

use Src\Common\Interfaces\Pages\IFactory;
use Src\Common\Interfaces\Pages\Sidebar\IFactory as ISidebarFactory;
use Src\Common\Pages\Sidebar\Factory as SidebarFactory;

class Factory implements IFactory {

    protected ?ISidebarFactory $sidebarFactory = null;

    protected array $conf;

    public function init(array $conf = []): void
    {
        $this->conf[ISidebarFactory::class] = [
            'class' => SidebarFactory::class,
            'conf' => [],
        ];
        $this->conf = array_replace_recursive($this->conf, $conf);
    }

    public function getSidebarFactory(): SidebarFactory
    {
        if($this->sidebarFactory === null){
            $this->sidebarFactory = new $this->conf[ISidebarFactory::class]['class'];
            $this->sidebarFactory->init($this->conf[ISidebarFactory::class]['conf']);
        }
        return $this->sidebarFactory;
    }

}