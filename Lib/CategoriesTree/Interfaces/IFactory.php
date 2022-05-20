<?php

namespace Src\Lib\CategoriesTree\Interfaces;

use Src\Common\Interfaces\IFactory as ICommonFactory;
use Src\Lib\CategoriesTree\Interfaces\Dto\IFactory as IDtoFactory;
use Src\Lib\CategoriesTree\Interfaces\Infrastructure\IFactory as IInfrastructureFactory;
use Src\Lib\CategoriesTree\Interfaces\Application\IFactory as IApplicationFactory;

interface IFactory {

    const DB_HOST = 'db_host';

    const DB_NAME = 'db_name';

    const DB_USER = 'db_user';

    const DB_PASS = 'db_pass';

    const DB_CHARSET = 'db_charset';
    
    const TABLE_NAME = 'table_name';

    public function setCommonFactory(ICommonFactory $factory);
    public function getCommonFactory():ICommonFactory;
    public function loadSettings(array $settings);
    public function getSetting(string $key);
    public function getSettings(): array;
    public function getDtoFactory():IDtoFactory;
    public function getInfrastructureFactory():IInfrastructureFactory;
    public function getApplicationFactory():IApplicationFactory;
}