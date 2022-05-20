import {IAbstractObject} from '../IAbstractObject';
import {IFileInputBus} from '../../bus/IFileInputBus';
import {TImageObject} from '../../../types/TImageObject';

export interface IImageInput extends IAbstractObject {
    setBus(bus:IFileInputBus):void;
    loadData(data:TImageObject):void;
    serialize():TImageObject;
}