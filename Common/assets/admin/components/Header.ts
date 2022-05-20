import {IHeader} from '../interfaces/components/IHeader';
import {IAdminPanelBus} from '../interfaces/bus/IAdminPanelBus';

export class Header implements IHeader {

    protected $container:JQuery;

    protected $sidebarToggleButton:JQuery;

    protected adminPanelBus:IAdminPanelBus;

    public init(container:JQuery)
    {
        this.$container = container;
        this.$sidebarToggleButton = this.$container.find('.js-sidebar-toggle-button');
        this.eventListen();
    }

    public setAdminPanelBus(bus:IAdminPanelBus):void
    {
        this.adminPanelBus = bus;
    }

    private eventListen():void
    {
        this.$sidebarToggleButton.on('click', this.onToggleButtonClick.bind(this));
    }

    private onToggleButtonClick(event:Event)
    {
        event.preventDefault();
        this.adminPanelBus.toggleSidebar();
    }

}