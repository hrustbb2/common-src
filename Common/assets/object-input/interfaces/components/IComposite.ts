import {IAbstractObject} from './IAbstractObject';
import {TComposite} from '../../types/TComposite';
import {IObjectBus} from '../bus/IObjectBus';
import {EInputTypes} from '../../types/EInputTypes';

export interface IComposite extends IAbstractObject {
    collapsedTemplate:JQuery;
    setFieldCreator(callback:(type:EInputTypes)=>IAbstractObject):void;
    setObjectBus(bus:IObjectBus):void;
    loadData(data:TComposite):void;
    getData():TComposite;
    build():Promise<TComposite>;
    draw():void;
    showSaveButton():void;
    showBackButton():void;
}