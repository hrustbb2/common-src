import {IFactory as IAppFactory} from '../IFactory';
import {IObjectBus} from './IObjectBus';
import {IFileInputBus} from './IFileInputBus';

export interface IFactory {
    setAppFactory(factory:IAppFactory):void;
    getObjectBus():IObjectBus;
    getFileInputBus():IFileInputBus;
}