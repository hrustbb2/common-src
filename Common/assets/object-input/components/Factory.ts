import {IFactory} from '../interfaces/components/IFactory';
import {IFactory as IAppFactory} from '../interfaces/IFactory';
import {IAbstractObject} from '../interfaces/components/IAbstractObject';
import {IComposite} from '../interfaces/components/IComposite';
import {EInputTypes} from '../types/EInputTypes';
import {IModal} from '../interfaces/components/IModal';
import {Modal} from './Modal';
import {Composite} from './Composite';
import {ObjectForm} from './ObjectForm';
import {IObjectForm} from '../interfaces/components/IObjectForm';
import {String} from './String';
import {Text} from './Text';
import {Color} from './Color';
import {Bool} from './Bool';
import {Select} from './Select';
import {ObjectsArray} from './ObjectsArray';
import {ArrayItem} from './ArrayItem';
import {IFactory as IFileInputFactory} from '../interfaces/components/file-input/IFactory';
import {Factory as FileInputFactory} from './file-input/Factory';
import 'jquery';

type TObjectForms = {
    [key:string]:IObjectForm;
}

export class Factory implements IFactory {
    
    protected appFactory:IAppFactory;

    protected modal:IModal = null;

    protected objectForms:TObjectForms = {};

    protected fileInputFactory:IFileInputFactory = null;

    public setAppFactory(factory:IAppFactory)
    {
        this.appFactory = factory;
    }

    public getAppFactory():IAppFactory
    {
        return this.appFactory;
    }

    public getModal():IModal
    {
        if(this.modal === null){
            this.modal = new Modal();
            this.modal.setObjCreator((type:EInputTypes)=>{
                return this.createInputField(type);
            });
            $('body').append(this.modal.template);
            this.modal.eventsListen();
        }
        return this.modal;
    }

    public createInputField(type:EInputTypes):IAbstractObject
    {
        let objectBus = this.appFactory.getBusFactory().getObjectBus();
        if(type == EInputTypes.string){
            let input = new String();
            return input;
        }
        if(type == EInputTypes.text){
            let input = new Text();
            return input;
        }
        if(type == EInputTypes.color){
            let input = new Color();
            return input;
        }
        if(type == EInputTypes.bool){
            let input = new Bool();
            return input;
        }
        if(type == EInputTypes.select){
            let input = new Select();
            return input;
        }
        if(type == EInputTypes.array){
            let input = new ObjectsArray();
            input.setObjectBus(objectBus);
            input.setItemCreator(()=>{
                let item = new ArrayItem();
                let objectBus = this.appFactory.getBusFactory().getObjectBus();
                item.setObjectBus(objectBus);
                return item;
            });
            return input;
        }
        if(type == EInputTypes.file){
            let input = this.getFileInputFactory().createFileInput();
            return input;
        }
        if(type == EInputTypes.image){
            let input = this.getFileInputFactory().createImageInput();
            return input;
        }
        let input = this.createComposite();
        return input;
    }

    public createComposite():IComposite
    {
        let objectBus = this.appFactory.getBusFactory().getObjectBus();
        let composite = new Composite();
        composite.setObjectBus(objectBus);
        composite.setFieldCreator((type:EInputTypes)=>{
            return this.createInputField(type);
        });
        return composite;
    }

    public getObjectForm(key:string):IObjectForm
    {
        if(!this.objectForms[key]){
            let objectForm = new ObjectForm();
            objectForm.setKey(key);
            objectForm.setCompositeCreator(()=>{
                return this.createComposite();
            });
            this.objectForms[key] = objectForm;
        }
        return this.objectForms[key];
    }

    public getFileInputFactory():IFileInputFactory
    {
        if(this.fileInputFactory === null){
            this.fileInputFactory = new FileInputFactory();
            this.fileInputFactory.setComponentsFactory(this);
        }
        return this.fileInputFactory;
    }

}