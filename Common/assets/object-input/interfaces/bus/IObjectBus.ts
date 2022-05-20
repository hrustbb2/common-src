import {IFactory as IComponentsFactory} from '../components/IFactory';
import {TAbstractObject} from '../../types/TAbstractObject';
import {TComposite} from '../../types/TComposite';

export interface IObjectBus {
    setComponentsFactory(factory:IComponentsFactory):void;
    execObjectModal(obj:TAbstractObject):Promise<TAbstractObject>;
    renderForm(composite:TComposite, objFormKey:string):Promise<TComposite>;
    rerender(objFormKey:string):void;
    back(objFormKey:string):void;
}