<?php

namespace Src\Lib\CategoriesTree\Interfaces\Infrastructure;

interface IMigrations
{
    public function init(array $settings): void;
    public function create(string $migrationsPath): void;
    public function migrate(string $migrationsPath): void;
    public function rollback(string $migrationsPath): void;
}
