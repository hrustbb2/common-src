import {TAbstractObject} from '../../types/TAbstractObject';
import {IAbstractObject} from '../components/IAbstractObject';
import {EInputTypes} from '../../types/EInputTypes';

export interface IModal {
    template:JQuery;
    setObjCreator(callback:(type:EInputTypes)=>IAbstractObject):void;
    show(obj:TAbstractObject):Promise<TAbstractObject>;
    hide():void;
    eventsListen():void;
}