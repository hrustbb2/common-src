<?php

namespace Src\Common\Interfaces;

interface IModulesProvider {
    public function getCommonFactory(): IFactory;
}