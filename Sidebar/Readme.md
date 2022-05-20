# Модуль бокового меню в админке

Подключение в ```ModulesProvider.php```:
```
use Src\Common\Interfaces\IModulesProvider as ICommonProvider;
use Src\Common\Interfaces\IFactory as ICommonFactory;
use Src\Common\Factory as CommonFactory;

use Src\Sidebar\Interfaces\IModulesProvider as ISidebarProvider;
use Src\Sidebar\Interfaces\IFactory as ISidebarFactory;
use Src\Sidebar\Factory as SidebarFactory;

class ModulesProvider implements ISidebarProvider {

    protected ?ICommonFactory $commonFactory = null;
    
    protected ?ISidebarFactory $sidebarFactory = null;

    public function getCommonFactory(): CommonFactory
    {
        if($this->commonFactory === null){
            $this->commonFactory = new CommonFactory();
            $this->commonFactory->init();
            $this->commonFactory->setFrameworkName(ICommonFactory::LARAVEL);
        }
        return $this->commonFactory;
    }

    public function getSidebarFactory(): SidebarFactory
    {
        if($this->sidebarFactory === null){
            $this->sidebarFactory = new SidebarFactory();
            $this->sidebarFactory->init();
            $this->sidebarFactory->injectModules($this);
        }
        return $this->sidebarFactory;
    }

}
```

Пример настройки в ```Src\Sidebar\Factory```:
```
public function getMenu(): Menu
{
    $menu = parent::getMenu();
    $menuData = [
        [
            'title' => 'Item1',
            'url' => '#',
        ],
        [
            'title' => 'Item2',
            'url' => '#',
        ],
        [
            'title' => 'Item3',
            'url' => '#',
            'subItems' => [
                [
                    'title' => 'Sub item1',
                    'url' => '#',
                    'bage' => '1',
                ],
                [
                    'title' => 'Sub item2',
                    'url' => '#',
                    'bage' => '2',
                ],
            ]
        ]
    ];
    $menu->load($menuData);
    return $menu;
}
```