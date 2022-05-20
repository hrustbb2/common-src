<?php

namespace Src\Common\Pages\Sidebar;

use Src\Common\Interfaces\Pages\Sidebar\IMenu;
use Src\Common\Interfaces\Pages\Sidebar\IItem;
use Src\Common\Interfaces\Pages\Sidebar\IFactory as ISidebarFactory;

class Menu implements IMenu {

    /**
     * @var IItem[]
     */
    protected $menuItems = [];

    /**
     * @var ISidebarFactory
     */
    protected $sidebarFactory;

    public function setSidebarFactory(ISidebarFactory $factory)
    {
        $this->sidebarFactory = $factory;
    }

    public function load(array $itemsData)
    {
        foreach($itemsData as $itemData){
            $menuItem = $this->sidebarFactory->createItem();
            $menuItem->load($itemData);
            $this->menuItems[] = $menuItem;
        }
    }

    public function getMenuItems()
    {
        return $this->menuItems;
    }

}