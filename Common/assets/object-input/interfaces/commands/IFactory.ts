import {IFactory as IAppFactory} from '../IFactory';
import {IFilesBrowserCommands} from '../commands/IFilesBrowserCommands';

export interface IFactory {
    setAppFactory(factory:IAppFactory):void;
    getFilesBrowserCommands():IFilesBrowserCommands;
}