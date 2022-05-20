<?php

namespace Src\Common\Pages\Sidebar;

use Src\Common\Interfaces\Pages\Sidebar\IItem;
use Src\Common\Interfaces\Pages\Sidebar\IFactory as ISidebarFactory;
use Src\Common\Interfaces\Pages\Sidebar\ISubItem;

class Item implements IItem {

    /**
     * @var ISubItem[]
     */
    protected array $subitems = [];

    protected $title;

    protected $url;

    /**
     * @var ISidebarFactory
     */
    protected $sidebarFactory;

    public function setSidebarFactory(ISidebarFactory $factory)
    {
        $this->sidebarFactory = $factory;
    }

    public function getSubItems()
    {
        return $this->subitems;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function load(array $itemData)
    {
        $this->title = $itemData['title'] ?? null;
        $this->url = $itemData['url'] ?? null;
        foreach($itemData['subItems'] ?? [] as $subItemData){
            $subItem = $this->sidebarFactory->createSubItem();
            $subItem->load($subItemData);
            $this->subitems[] = $subItem;
        }
    }

}