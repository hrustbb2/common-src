<?php

namespace Src\Common\Interfaces\Infrastructure;

interface IQueryBase {
    /**
     * @return array
     */
    public function all(): array;

    /**
     * @return array
     */
    public function one(): array;
}
