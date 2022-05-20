<?php

namespace Src\Common\Adapters\Laravel;

use Src\Common\Interfaces\Adapters\IHash;
use Illuminate\Support\Facades\Hash as HashFacade;

class Hash implements IHash {

    public function make(string $value)
    {
        return HashFacade::make($value);
    }

    public function check(string $hash)
    {
        return HashFacade::check($hash);
    }

}