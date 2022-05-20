<?php

namespace Src\Common\Interfaces;

use Src\Common\Interfaces\Pages\IFactory as IPagesFactory;
use Src\Common\Interfaces\Adapters\IAdaptersFactory;
use Src\Common\Interfaces\Dto\IFactory as IDtoFactory;
use Src\Common\Interfaces\Application\IFilesBrowser;

interface IFactory {
    const LARAVEL = 'laravel';
    public function init(array $conf = []): void;
    public function setFrameworkName(string $name):void;
    public function getPagesFactory():IPagesFactory;
    public function getAdaptersFactory():IAdaptersFactory;
    public function getDtoFactory():IDtoFactory;
    public function getFilesBrowser():IFilesBrowser;
}