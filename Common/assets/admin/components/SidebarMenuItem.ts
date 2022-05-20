import {ISidebarMenuItem} from '../interfaces/components/ISidebarMenuItem';
import 'jquery';

export class SidebarMenuItem implements ISidebarMenuItem {

    private $container:JQuery;

    private $subItems:JQuery;

    private $subItemsToggleButton:JQuery;

    private $itemName:JQuery;

    private $itemButton:JQuery;

    private isSubItemsCollapsed:boolean = true;

    public init(container:JQuery)
    {
        this.$container = container;
        this.$subItems = this.$container.find('.js-sub-items');
        this.$subItemsToggleButton = this.$container.find('.js-sub-items-toggle-button');
        this.$itemName = this.$container.find('.js-item-name');
        this.$itemButton = this.$container.find('.js-sidebar-menu-item-button');
        this.eventListen();
    }

    private eventListen()
    {
        this.$itemButton.on('click', this.onClick.bind(this));
    }

    private onClick(event:Event)
    {
        this.subItemsToggle();
    }

    private subItemsToggle():void
    {
        if(this.isSubItemsCollapsed){
            this.showSubItems();
        }else{
            this.hideSubItems();
        }
    }

    private hideSubItems()
    {
        this.isSubItemsCollapsed = true;
        this.$container.removeClass('menu-open');
    }

    private showSubItems()
    {
        this.isSubItemsCollapsed = false;
        this.$container.addClass('menu-open');
    }
}