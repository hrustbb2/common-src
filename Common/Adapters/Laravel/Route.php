<?php

namespace Src\Common\Adapters\Laravel;

use Src\Common\Interfaces\Adapters\IRoute;

class Route implements IRoute {

    public function getRoute(string $name, array $params = [])
    {
        return route($name, $params);
    }

}