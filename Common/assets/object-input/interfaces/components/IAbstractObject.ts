import {TAbstractObject} from '../../types/TAbstractObject';

export interface IAbstractObject {
    template:JQuery;
    loadData(data:TAbstractObject):void;
    showErrors():void;
    clearErrors():void;
    serialize():TAbstractObject;
    eventsListen():void;
    setFormKey(key:string):void;
}