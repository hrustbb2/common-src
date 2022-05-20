import {IAdminPanelBus} from '../interfaces/bus/IAdminPanelBus';
import {IFactory as IComponentsFactory} from '../interfaces/components/IFactory';

export class AdminPanelBus implements IAdminPanelBus {

    protected componentsFactory:IComponentsFactory;

    public setComponentsFactory(factory:IComponentsFactory)
    {
        this.componentsFactory = factory;
    }

    public toggleSidebar()
    {
        this.componentsFactory.getAdminPanel().toggleSidebar();
    }

    public collapseSidebar()
    {
        this.componentsFactory.getAdminPanel().collapseSidebar();
    }

    public execMessageModal(header:string, message:string)
    {
        let modal = this.componentsFactory.getMessageModal();
        modal.show(header, message);
    }

    public execConfirmModal(header:string, message:string):Promise<any>
    {
        let modal = this.componentsFactory.getConfirmModal();
        return modal.show(header, message);
    }

}