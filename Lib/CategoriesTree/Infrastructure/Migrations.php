<?php

namespace Src\Lib\CategoriesTree\Infrastructure;

use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IMigrations;
use hrustbb2\Migrations\JSONManager;
use hrustbb2\Migrations\Interfaces\IManager;
use Src\Lib\CategoriesTree\Interfaces\IFactory as ILibFactory;
use hrustbb2\Migrations\MigrationCreator;
use hrustbb2\Migrations\Interfaces\IMigrationCreator;

class Migrations implements IMigrations
{

    protected IManager $manager;

    protected IMigrationCreator $creator;

    public function init(array $settings): void
    {
        $this->manager = new JSONManager();
        $this->manager->setDbHost($settings[ILibFactory::DB_HOST]);
        $this->manager->setDbName($settings[ILibFactory::DB_NAME]);
        $this->manager->setDbPassword($settings[ILibFactory::DB_PASS]);
        $this->manager->setDbUser($settings[ILibFactory::DB_USER]);
        $this->manager->setMigrationPath(__DIR__ . '/../migrations');
        $this->manager->setSettings($settings);
        $this->manager->init();

        $this->creator = new MigrationCreator();
        $this->creator->setMigrationPath(__DIR__ . '/../migrations');
    }

    public function create(): void
    {
        $this->creator->create('Migration');
    }

    public function migrate(): void
    {
        $migrations = $this->manager->getNewMigrations();
        $this->manager->migrate($migrations);
    }

    public function rollback(): void
    {
        $this->manager->rollback();
    }

}
