import {IFactory} from '../interfaces/commands/IFactory';
import {IFactory as IAppFactory} from '../interfaces/IFactory';
import {IFilesBrowserCommands} from '../interfaces/commands/IFilesBrowserCommands';
import {FilesBrowserCommands} from './FilesBrowserCommands';

export class Factory implements IFactory {

    protected appFactory:IAppFactory;

    protected filesBrowserCommands:IFilesBrowserCommands = null;

    public setAppFactory(factory:IAppFactory)
    {
        this.appFactory = factory;
    }

    public getFilesBrowserCommands():IFilesBrowserCommands
    {
        if(this.filesBrowserCommands === null){
            this.filesBrowserCommands = new FilesBrowserCommands();
        }
        return this.filesBrowserCommands;
    }

}