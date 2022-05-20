<?php

namespace Src\Sidebar\Interfaces;

use Src\Common\Interfaces\IFactory as ICommonFactory;

interface IModulesProvider {

    public function getSidebarFactory():IFactory;

    public function getCommonFactory():ICommonFactory;
}