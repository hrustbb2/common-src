<?php

namespace Src\Common\Interfaces\Pages\Sidebar;

use Src\Common\Interfaces\Pages\Sidebar\IFactory as ISidebarFactory;

interface ISubItem {
    public function load(array $subItemData);
    public function setSidebarFactory(ISidebarFactory $factory);
    public function getTitle();
    public function getUrl();
    public function getBage();
}