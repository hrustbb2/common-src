<?php

namespace Src\Common\Interfaces\Adapters;

interface ILog {
    public function alert(string $message, array $context = []):void;
    public function critical(string $message, array $context = []):void;
    public function debug(string $message, array $context = []):void;
    public function emergency(string $message, array $context = []):void;
    public function error(string $message, array $context = []):void;
}