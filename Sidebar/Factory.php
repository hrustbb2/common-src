<?php

namespace Src\Sidebar;

use Src\Sidebar\Interfaces\IFactory;
use Src\Sidebar\Interfaces\IModulesProvider;
use Src\Common\Interfaces\Adapters\IRoute;
use Src\Common\Pages\Sidebar\Factory as BaseFactory;
use Src\Common\Pages\Sidebar\Menu;

class Factory extends BaseFactory implements IFactory {

    protected IRoute $routeAdapter;

    protected array $settings = [];

    public function loadSettings(array $settings): void
    {
        $this->settings = $settings;
    }

    public function injectModules(IModulesProvider $provider): void
    {
        $this->routeAdapter = $provider->getCommonFactory()->getAdaptersFactory()->getRoute();
    }
    
    public function getMenu(): Menu
    {
        $menu = parent::getMenu();
        $menuData = [
            [
                'title' => 'JsonObjects',
                'url' => $this->routeAdapter->getRoute('admin.jsonObjects.dir'),
            ],
        ];
        $menu->load($menuData);
        return $menu;
    }

}