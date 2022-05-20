<?php

namespace Src\Common\Adapters\Laravel;

use Src\Common\Interfaces\Adapters\ILog;
use Illuminate\Support\Facades\Log as LogFacade;

class Log implements ILog {

    public function alert(string $message, array $context = []):void
    {
        LogFacade::alert($message, $context);
    }

    public function critical(string $message, array $context = []):void
    {
        LogFacade::critical($message, $context);
    }

    public function debug(string $message, array $context = []):void
    {
        LogFacade::debug($message, $context);
    }

    public function emergency(string $message, array $context = []):void
    {
        LogFacade::emergency($message, $context);
    }

    public function error(string $message, array $context = []):void
    {
        LogFacade::error($message, $context);
    }

}