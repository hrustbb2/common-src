import {IFactory} from '../interfaces/bus/IFactory';
import {IFactory as IAppFactory} from '../interfaces/IFactory';
import {IObjectBus} from '../interfaces/bus/IObjectBus';
import {ObjectBus} from './ObjectBus';
import {IFileInputBus} from '../interfaces/bus/IFileInputBus';
import {FileInputBus} from './FileInputBus';

export class Factory implements IFactory {

    protected appFactory:IAppFactory;

    protected objectBus:IObjectBus = null;

    protected fileInputBus:IFileInputBus = null;

    public setAppFactory(factory:IAppFactory)
    {
        this.appFactory = factory;
    }

    public getObjectBus():IObjectBus
    {
        if(this.objectBus === null){
            this.objectBus = new ObjectBus();
            let componentsFactory = this.appFactory.getComponentsFactory();
            this.objectBus.setComponentsFactory(componentsFactory);
        }
        return this.objectBus;
    }

    public getFileInputBus():IFileInputBus
    {
        if(this.fileInputBus === null){
            this.fileInputBus = new FileInputBus();
            let componentsFactory = this.appFactory.getComponentsFactory();
            this.fileInputBus.setComponentsFactory(componentsFactory);
        }
        return this.fileInputBus;
    }

}