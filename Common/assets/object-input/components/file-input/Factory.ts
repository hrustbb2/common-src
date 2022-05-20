import {IFactory} from '../../interfaces/components/file-input/IFactory';
import {IFactory as IComponentsFactory} from '../../interfaces/components/IFactory';
import {IFileInput} from '../../interfaces/components/file-input/IFileInput';
import {FileInput} from './FileInput';
import {IImageInput} from '../../interfaces/components/file-input/IImageInput';
import {ImageInput} from './ImageInput';
import {IBrowserModal} from '../../interfaces/components/file-input/IBrowserModal';
import {BrowserModal} from './BrowserModal';
import {IItem} from '../../interfaces/components/file-input/IItem';
import {Item} from './Item';
import {IFileContextMenu} from '../../interfaces/components/file-input/IFileContextMenu';
import {FileContextMenu} from './FileContextMenu';

export class Factory implements IFactory {

    protected componentsFactory:IComponentsFactory;

    protected browserModal:IBrowserModal = null;

    protected fileContextMenu:IFileContextMenu = null;

    public setComponentsFactory(factory:IComponentsFactory)
    {
        this.componentsFactory = factory;
    }

    public createFileInput():IFileInput
    {
        let fileInput = new FileInput();
        let bus = this.componentsFactory.getAppFactory().getBusFactory().getFileInputBus();
        fileInput.setBus(bus);
        return fileInput;
    }

    public createImageInput():IImageInput
    {
        let imageInput = new ImageInput();
        let bus = this.componentsFactory.getAppFactory().getBusFactory().getFileInputBus();
        imageInput.setBus(bus);
        return imageInput;
    }

    public getBrowserModal():IBrowserModal
    {
        if(this.browserModal === null){
            this.browserModal = new BrowserModal();
            let bus = this.componentsFactory.getAppFactory().getBusFactory().getFileInputBus();
            this.browserModal.setFileInputBus(bus);
            this.browserModal.setItemCreator(()=>{
                return this.createItem();
            });
            let commands = this.componentsFactory.getAppFactory().getCommandsFactory().getFilesBrowserCommands();
            this.browserModal.setFilesBrowserCommands(commands);
            $('body').append(this.browserModal.template);
            this.browserModal.eventsListen();
        }
        return this.browserModal;
    }

    protected createItem():IItem
    {
        let item = new Item();
        let commands = this.componentsFactory.getAppFactory().getCommandsFactory().getFilesBrowserCommands();
        item.setFBCommands(commands);
        let bus = this.componentsFactory.getAppFactory().getBusFactory().getFileInputBus();
        item.setFBBus(bus);
        return item;
    }

    public getFileContextMenu():IFileContextMenu
    {
        if(this.fileContextMenu === null){
            this.fileContextMenu = new FileContextMenu();
            let commands = this.componentsFactory.getAppFactory().getCommandsFactory().getFilesBrowserCommands();
            this.fileContextMenu.setFilesBrowserCommands(commands);
            let bus = this.componentsFactory.getAppFactory().getBusFactory().getFileInputBus();
            this.fileContextMenu.setFileBrowserBus(bus);
            $('body').append(this.fileContextMenu.template);
            this.fileContextMenu.eventsListen();
        }
        return this.fileContextMenu;
    }

}