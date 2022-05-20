<?php

namespace Src\Common\Interfaces\Pages\Sidebar;

use Src\Common\Interfaces\Pages\Sidebar\ISubItem;
use Src\Common\Interfaces\Pages\Sidebar\IFactory as ISidebarFactory;

interface IItem {
    public function setSidebarFactory(ISidebarFactory $factory);
    /**
     * @return ISubItem[]
     */
    public function getSubItems();
    public function getTitle();
    public function getUrl();
    public function load(array $itemData);
}