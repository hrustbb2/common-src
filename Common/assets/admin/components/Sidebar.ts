import {ISidebar} from '../interfaces/components/ISidebar';
import {ISidebarMenu} from '../interfaces/components/ISidebarMenu';
import {Factory} from '../Factory';

export class Sidebar implements ISidebar {

    private $container:JQuery;

    private menu:ISidebarMenu;

    public setMenu(menu:ISidebarMenu)
    {
        this.menu = menu;
    }

    public init(container:JQuery)
    {
        this.$container = container;
        let menuElement = this.$container.find('.js-sidebar-menu');
        this.menu.init(menuElement);
    }

}