<?php

namespace Src\Common\Interfaces\Pages;

use Src\Common\Interfaces\Pages\Sidebar\IMenu;
use Src\Common\Interfaces\Adapters\IRoute;

interface IAbstractPage {
    public function setRouteAdapter(IRoute $adapter):void;
    public function getCssStack();
    public function getJsStack();
    public function getJsSettings();
    public function getTitle();
    public function setSidebar(IMenu $menu);
    public function getSidebar();
}
