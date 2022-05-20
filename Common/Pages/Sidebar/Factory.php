<?php

namespace Src\Common\Pages\Sidebar;

use Src\Common\Interfaces\Pages\Sidebar\IFactory;
use Src\Common\Interfaces\Pages\Sidebar\IMenu;
use Src\Common\Interfaces\Pages\Sidebar\IItem;
use Src\Common\Interfaces\Pages\Sidebar\ISubItem;

class Factory implements IFactory {

    /**
     * @var IMenu
     */
    protected ?IMenu $menu = null;

    protected array $conf;

    public function init(array $conf = []): void
    {
        $this->conf = $conf;
        $this->conf[IMenu::class] = [
            'class' => Menu::class,
        ];
        $this->conf[IItem::class] = [
            'class' => Item::class,
        ];
        $this->conf[ISubItem::class] = [
            'class' => SubItem::class,
        ];
    }

    public function getMenu(): Menu
    {
        if($this->menu === null){
            $this->menu = new $this->conf[IMenu::class]['class'];
            $this->menu->setSidebarFactory($this);
        }
        return $this->menu;
    }

    public function createItem(): Item
    {
        $item = new $this->conf[IItem::class]['class'];
        $item->setSidebarFactory($this);
        return $item;
    }

    public function createSubItem(): SubItem
    {
        $subItem = new $this->conf[ISubItem::class]['class'];
        $subItem->setSidebarFactory($this);
        return $subItem;
    }

}