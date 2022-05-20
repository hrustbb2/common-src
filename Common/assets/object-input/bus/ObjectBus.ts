import {IObjectBus} from '../interfaces/bus/IObjectBus';
import {IFactory as IComponentsFactory} from '../interfaces/components/IFactory';
import {TComposite} from '../types/TComposite';
import {TAbstractObject} from '../types/TAbstractObject';

export class ObjectBus implements IObjectBus {

    protected componentsFactory:IComponentsFactory;

    public setComponentsFactory(factory:IComponentsFactory)
    {
        this.componentsFactory = factory;
    }

    public execObjectModal(obj:TAbstractObject):Promise<TAbstractObject>
    {
        return this.componentsFactory.getModal().show(obj);
    }

    public renderForm(data:TComposite, objFormKey:string):Promise<TComposite>
    {
        return this.componentsFactory.getObjectForm(objFormKey).render(data);
    }

    public rerender(objFormKey:string)
    {
        this.componentsFactory.getObjectForm(objFormKey).rerender();
    }

    public back(objFormKey:string)
    {
        this.componentsFactory.getObjectForm(objFormKey).back();
    }

}