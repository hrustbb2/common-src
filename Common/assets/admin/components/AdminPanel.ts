import {IAdminPanel} from '../interfaces/components/IAdminPanel';
import {ISidebar} from '../interfaces/components/ISidebar';
import {IHeader} from '../interfaces/components/IHeader';
import {IContent} from '../interfaces/components/IContent';
import 'jquery';

export class AdminPanel implements IAdminPanel {

    private $container:JQuery;

    private _sidebar:ISidebar;

    private _header:IHeader;

    private _content:IContent;

    private isSidebarClosed = false;

    public setSidebar(sidebar:ISidebar)
    {
        this._sidebar = sidebar;
    }

    public setHeader(header:IHeader)
    {
        this._header = header;
    }

    public setContent(content:IContent)
    {
        this._content = content;
    }

    public init(container:JQuery)
    {
        this.$container = container;
        let headerElement = $('.js-main-header');
        this._header.init(headerElement);
        let sidebarElement = $('.js-main-sidebar');
        this._sidebar.init(sidebarElement);
        let contentElement = $('.js-content');
        this._content.init(contentElement);
    }

    public get header():IHeader
    {
        return this._header;
    }

    public get sidebar():ISidebar
    {
        return this._sidebar;
    }

    public get content():IContent
    {
        return this._content;
    }

    public toggleSidebar()
    {
        if(this.isSidebarClosed){
            this.$container.removeClass('closed-sidebar');
            this.$container.addClass('openned-sidebar');
        }else{
            this.$container.addClass('closed-sidebar');
            this.$container.removeClass('openned-sidebar');
        }
        this.isSidebarClosed = !this.isSidebarClosed;
    }

    public collapseSidebar()
    {
        this.isSidebarClosed = true;
        this.$container.addClass('closed-sidebar');
        this.$container.removeClass('openned-sidebar');
    }

}