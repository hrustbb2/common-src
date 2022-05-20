<?php

namespace Src\Common\Pages;

use Src\Common\Interfaces\Pages\Sidebar\IMenu;
use Src\Common\Interfaces\Adapters\IRoute;

abstract class Page {

    const CSS_VERSION = '4.0';

    const JS_VERSION = '4.0';

    protected IMenu $sidebar;

    protected IRoute $routeAdapter;

    public function setRouteAdapter(IRoute $adapter):void
    {
        $this->routeAdapter = $adapter;
    }

    /**
     * @return array
     */
    public abstract function getCssStack():array;

    /**
     * @return array
     */
    public abstract function getJsStack():array;

    /**
     * @return array
     */
    public function getCommonJsSettings():array
    {
        return [];
    }

    /**
     * @return array
     */
    public abstract function getJsSettings():array;

    /**
     * @return string
     */
    public abstract function getTitle():string;

    public function setSidebar(IMenu $menu):void
    {
        $this->sidebar = $menu;
    }

    /**
     * @return IMenu
     */
    public function getSidebar():IMenu
    {
        return $this->sidebar;
    }

}