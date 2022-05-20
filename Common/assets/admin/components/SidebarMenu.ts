import {ISidebarMenu} from '../interfaces/components/ISidebarMenu';
import {ISidebarMenuItem} from '../interfaces/components/ISidebarMenuItem';

export class SidebarMenu implements ISidebarMenu {

    protected $container:JQuery;
    
    protected items:ISidebarMenuItem[];

    protected itemCreator:()=>ISidebarMenuItem;

    public setItemCreator(callback:()=>ISidebarMenuItem)
    {
        this.itemCreator = callback;
    }

    public init(container:JQuery)
    {
        this.$container = container;
        let items = this.$container.find('.js-sidebar-menu-item-container');
        this.items = [];
        items.each((i:number, el:HTMLElement)=>{
            let menuItem = this.itemCreator();
            menuItem.init($(el));
            this.items.push(menuItem);
        });
    }
}