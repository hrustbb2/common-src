<?php

namespace Src\Common\Interfaces\Pages\Sidebar;

interface IFactory {
    
    public function init(array $conf = []): void;
    
    public function getMenu(): IMenu;

    public function createItem(): IItem;

    public function createSubItem(): ISubItem;
}