<?php

namespace Src\Common\Pages\Sidebar;

use Src\Common\Interfaces\Pages\Sidebar\ISubItem;
use Src\Common\Interfaces\Pages\Sidebar\IFactory as ISidebarFactory;

class SubItem implements ISubItem {

    protected $title;

    protected $url;

    protected $bage;

    /**
     * @var ISidebarFactory
     */
    protected ISidebarFactory $sidebarFactory;

    public function setSidebarFactory(ISidebarFactory $factory)
    {
        $this->sidebarFactory = $factory;
    }

    public function load(array $subItemData)
    {
        $this->title = $subItemData['title'] ?? null;
        $this->url = $subItemData['url'] ?? null;
        $this->bage = $subItemData['bage'] ?? null;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getBage()
    {
        return $this->bage;
    }

}