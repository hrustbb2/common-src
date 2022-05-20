import {IFactory as IComponentsFactory} from '../../interfaces/components/IFactory';
import {TFilesBrowserIcon} from '../../types/TFilesBrowserIcon';

export interface IFileInputBus {
    setComponentsFactory(factory:IComponentsFactory):void;
    execBrowserModal():Promise<string>;
    updateFileBrowser(icons:TFilesBrowserIcon[], path:string):void;
    execItemContextMenu(x:number, y:number, icon:TFilesBrowserIcon):void;
    execItemModal(name?:string):Promise<string>;
    hideItemContextMenu():void;
    deletedFile(path:string):void;
    renamedFile(path:string, newName:string):void;
    createdDir(path:string, name:string):void;
    uploadedFile(path:string, name:string):void;
}