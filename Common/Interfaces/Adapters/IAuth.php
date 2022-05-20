<?php

namespace Src\Common\Interfaces\Adapters;

interface IAuth {
    /**
     * @return boolean
     */
    public function attempt(array $credentials);
}