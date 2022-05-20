<?php

namespace Src\Sidebar\Interfaces;

use Src\Common\Interfaces\Pages\Sidebar\IFactory as IBaseFactory;
use Src\Sidebar\Interfaces\IModulesProvider;

interface IFactory extends IBaseFactory {
    public function loadSettings(array $settings): void;
    public function injectModules(IModulesProvider $provider): void;
}