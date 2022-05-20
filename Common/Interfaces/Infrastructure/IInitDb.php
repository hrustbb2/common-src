<?php

namespace Src\Common\Interfaces\Infrastructure;

interface IInitDb {
    public function setDriver(string $driver);
    public function setDbHost(string $host);
    public function setDbName(string $dbName);
    public function setDbPassword(string $password);
    public function setDbUser(string $user);
    public function setDbCharset(string $charset);
}