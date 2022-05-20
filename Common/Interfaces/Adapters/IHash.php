<?php

namespace Src\Common\Interfaces\Adapters;

interface IHash {
    public function make(string $value);

    /**
     * @return bool
     */
    public function check(string $hash);
}