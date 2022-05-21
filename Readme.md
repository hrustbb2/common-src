# Общий функционал для админ-панели и некоторых частей модулей.

Клонируем ```git clone https://github.com/hrustbb2/common-src.git ./src```

В ```composer.json``` добавляем строчку ```"Src\\": "src/",```:
```
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Src\\": "src/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/"
    }
},
```

В ```app/Providers/AppServiceProvider.php``` добавляем:
```
const ADMIN_MODULES = 'admin_modules';

public function boot()
{
    $this->loadViewsFrom(__DIR__ . '/../../src/views', 'common');
    $this->app->singleton(self::ADMIN_MODULES, function ($app) {
        return new AdminModulesProvider();
    });
}
```

Обратите внимание на строки в ```ModulesProvider.php```:
```
use Src\Common\Interfaces\IModulesProvider as ICommonProvider;
use Src\Common\Interfaces\IFactory as ICommonFactory;
use Src\Common\Factory as CommonFactory;

class ModulesProvider implements ICommonProvider {

    protected ?ICommonFactory $commonFactory = null;

    public function getCommonFactory(): CommonFactory
    {
        if($this->commonFactory === null){
            $this->commonFactory = new CommonFactory();
            $this->commonFactory->init();
            // Пример для Laravel
            $this->commonFactory->setFrameworkName(ICommonFactory::LARAVEL);
        }
        return $this->commonFactory;
    }

}
```
Примерно так сюда подключается большинство модулей.

Подключение в routes/web.php (для Laravel)
```
require __DIR__ . '/../src/Common/Laravel/routes.php';
```
Также необходимо создать файл config/admin.php со следующим содержанием:
```
<?php

return [
    'filesBrowser' => [
        'rootDir' => __DIR__ . '/../storage/uploads',
    ],
];
```
И, разумеется, создать дирректорию с правами на запись ```/../storage/uploads```

Подключение на стороне фронтенда для различных модулей:
```
import {Factory as AdminPanelFactory} from '@common/admin/Factory';

$(()=>{
    let adminPanelFactory = new AdminPanelFactory();
    adminPanelFactory.initAdminPanel();
});
```
saas файл со стилями:
```
@import "~common/css/main.scss";
@import "../../node_modules/bootstrap/dist/css/bootstrap.css";
```