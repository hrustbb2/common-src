<?php

use Phinx\Db\Table;
use hrustbb2\Migrations\AbstractMigrate;
use Src\Lib\CategoriesTree\Interfaces\IFactory as ILibFactory;

class Migration_1652891836 extends AbstractMigrate
{
    public function up(array $settings): void
    {
        $table = new Table($settings[ILibFactory::TABLE_NAME], ['id' => false, 'primary_key' => ['id']], $this->adapter);
        $table  ->addColumn('id', 'string')
                ->addColumn('matherial_path', 'string')
                ->addColumn('parent_id', 'string')
                ->addColumn('name', 'string')
                ->create();
    }

    public function down(array $settings): void
    {
        $table = new Table($settings[ILibFactory::TABLE_NAME], ['id' => false, 'primary_key' => ['id']], $this->adapter);
        $table->drop()->save();
    }
}
