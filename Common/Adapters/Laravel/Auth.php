<?php

namespace Src\Common\Adapters\Laravel;

use Src\Common\Interfaces\Adapters\IAuth;
use Illuminate\Support\Facades\Auth as AuthFacade;

class Auth implements IAuth {

    public function attempt(array $credentials)
    {
        return AuthFacade::attempt($credentials);
    }

}