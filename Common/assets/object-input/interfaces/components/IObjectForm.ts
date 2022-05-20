import {IComposite} from '../../interfaces/components/IComposite';
import {TComposite} from '../../types/TComposite';
import {TAbstractObject} from '../../types/TAbstractObject';

export interface IObjectForm {
    setCompositeCreator(callback:()=>IComposite):void;
    setKey(key:string):void;
    init(container:JQuery):void;
    setData(data:TComposite):void;
    getData():TAbstractObject;
    render(composite:TComposite):Promise<TComposite>;
    rerender():void;
    back():void;
    getFormData(fieldName?:string, form?:FormData):FormData;
}