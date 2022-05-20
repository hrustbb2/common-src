<?php

namespace Src\Common\Interfaces\Pages\Sidebar;

use Src\Common\Interfaces\Pages\Sidebar\IItem;
use Src\Common\Interfaces\Pages\Sidebar\IFactory as ISidebarFactory;

interface IMenu {
    public function load(array $itemsData);
    /**
     * @return IItem[]
     */
    public function getMenuItems();

    public function setSidebarFactory(ISidebarFactory $factory);
}