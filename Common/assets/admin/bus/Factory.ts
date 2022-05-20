import {IFactory} from '../interfaces/bus/IFactory';
import {IFactory as IAdminPanelFactory} from '../interfaces/IFactory';
import {IAdminPanelBus} from '../interfaces/bus/IAdminPanelBus';
import {AdminPanelBus} from './AdminPanelBus';

export class Factory implements IFactory {

    protected adminPanelFactory:IAdminPanelFactory;

    protected adminPanelBus:IAdminPanelBus = null;

    public setAdminPanelFactory(factory:IAdminPanelFactory)
    {
        this.adminPanelFactory = factory;
    }

    public getAdminPanelBus():IAdminPanelBus
    {
        if(this.adminPanelBus === null){
            this.adminPanelBus = new AdminPanelBus();
            let componentsFactory = this.adminPanelFactory.getComponentsFactory();
            this.adminPanelBus.setComponentsFactory(componentsFactory);
        }
        return this.adminPanelBus;
    }

}