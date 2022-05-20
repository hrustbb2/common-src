import {IFactory} from '../interfaces/components/IFactory';
import {IFactory as IAdminPanelFactory} from '../interfaces/IFactory';
import {IAdminPanel} from '../interfaces/components/IAdminPanel';
import {AdminPanel} from './AdminPanel';
import {ISidebar} from '../interfaces/components/ISidebar';
import {Sidebar} from './Sidebar';
import {ISidebarMenu} from '../interfaces/components/ISidebarMenu';
import {SidebarMenu} from './SidebarMenu';
import {ISidebarMenuItem} from '../interfaces/components/ISidebarMenuItem';
import {SidebarMenuItem} from './SidebarMenuItem';
import {IHeader} from '../interfaces/components/IHeader';
import {Header} from './Header';
import {IBox} from '../interfaces/components/IBox';
import {Box} from './Box';
import {IContent} from '../interfaces/components/IContent';
import {Content} from '../components/Content';
import {IConfirmModal} from '../interfaces/components/IConfirmModal';
import {ConfirmModal} from '../components/ConfirmModal';
import {IMessageModal} from '../interfaces/components/IMessageModal';
import {MessageModal} from '../components/MessageModal';
import 'jquery';

export class Factory implements IFactory {

    protected adminPanelFactory:IAdminPanelFactory;
    
    protected adminPanel:IAdminPanel = null;

    protected confirmModal:IConfirmModal = null;

    protected messageModal:IMessageModal = null;

    public setAdminPanelFactory(factory:IAdminPanelFactory)
    {
        this.adminPanelFactory = factory;
    }

    public getAdminPanel():IAdminPanel
    {
        return this.adminPanel;
    }

    public initAdminPanel()
    {
        let element = $('.js-wrapper');
        this.adminPanel = new AdminPanel();
        let sidebar = this.createSidebar();
        this.adminPanel.setSidebar(sidebar);
        let header = this.createHeader();
        this.adminPanel.setHeader(header);
        let content = this.createContent();
        this.adminPanel.setContent(content);
        this.adminPanel.init(element);
    }

    protected createSidebar():ISidebar
    {
        let sidebar = new Sidebar();
        let menu = this.createSidebarMenu();
        sidebar.setMenu(menu);
        return sidebar;
    }

    protected createSidebarMenu():ISidebarMenu
    {
        let menu = new SidebarMenu();
        menu.setItemCreator(()=>{
            return this.createSidebarMenuItem();
        });
        return menu;
    }

    protected createSidebarMenuItem():ISidebarMenuItem
    {
        return new SidebarMenuItem();
    }

    protected createHeader():IHeader
    {
        let headerComponent = new Header();
        let adminPanelBus = this.adminPanelFactory.getBusFactory().getAdminPanelBus();
        headerComponent.setAdminPanelBus(adminPanelBus);
        return headerComponent;
    }

    protected createBox():IBox
    {
        let boxComponent = new Box();

        return boxComponent;
    }

    protected createContent():IContent
    {
        let contentComponent = new Content();
        contentComponent.setBoxCreator(()=>{
            return this.createBox();
        });
        return contentComponent;
    }

    public getConfirmModal():IConfirmModal
    {
        if(this.confirmModal === null){
            this.confirmModal = new ConfirmModal();
            $('body').append(this.confirmModal.template);
            this.confirmModal.eventListen();
        }
        return this.confirmModal;
    }

    public getMessageModal():IMessageModal
    {
        if(this.messageModal === null){
            this.messageModal = new MessageModal();
            $('body').append(this.messageModal.template);
            this.messageModal.eventListen();
        }
        return this.messageModal;
    }
}