import {IAbstractObject} from './IAbstractObject';
import {IArrayItem} from './IArrayItem';
import {IObjectBus} from '../bus/IObjectBus';

export interface IObjectsArray extends IAbstractObject {
    setObjectBus(bus:IObjectBus):void;
    setItemCreator(callback:()=>IArrayItem):void;
}