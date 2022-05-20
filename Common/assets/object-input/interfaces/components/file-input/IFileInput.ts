import {IAbstractObject} from '../IAbstractObject';
import {IFileInputBus} from '../../bus/IFileInputBus';

export interface IFileInput extends IAbstractObject {
    setBus(bus:IFileInputBus):void;
}