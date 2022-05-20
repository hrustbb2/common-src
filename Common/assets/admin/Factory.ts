import {IFactory} from './interfaces/IFactory';
import {IFactory as IComponentsFactory} from './interfaces/components/IFactory';
import {Factory as ComponentsFactory} from './components/Factory';
import {IFactory as IBusFactory} from './interfaces/bus/IFactory';
import {Factory as BusFactory} from './bus/Factory';

export class Factory implements IFactory {

    protected componentsFactoryInstance:IComponentsFactory = null;

    protected busFactory:IBusFactory = null;

    public getComponentsFactory():IComponentsFactory
    {
        if(this.componentsFactoryInstance === null){
            this.componentsFactoryInstance = new ComponentsFactory();
            this.componentsFactoryInstance.setAdminPanelFactory(this);
        }
        return this.componentsFactoryInstance;
    }

    public getBusFactory():IBusFactory
    {
        if(this.busFactory === null){
            this.busFactory = new BusFactory();
            this.busFactory.setAdminPanelFactory(this);
        }
        return this.busFactory;
    }

    public initAdminPanel()
    {
        this.getComponentsFactory().initAdminPanel();
        if($(window).width() < 550){
            this.getBusFactory().getAdminPanelBus().collapseSidebar();
        }
    }
}