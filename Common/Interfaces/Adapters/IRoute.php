<?php

namespace Src\Common\Interfaces\Adapters;

interface IRoute {
    public function getRoute(string $name, array $params = []);
}