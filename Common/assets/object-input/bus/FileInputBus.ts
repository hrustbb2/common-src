import {IFileInputBus} from '../interfaces/bus/IFileInputBus';
import {IFactory as IComponentsFactory} from '../interfaces/components/IFactory';
import {TFilesBrowserIcon} from '../types/TFilesBrowserIcon';

export class FileInputBus implements IFileInputBus {

    protected componentsFactory:IComponentsFactory;

    public setComponentsFactory(factory:IComponentsFactory)
    {
        this.componentsFactory = factory;
    }

    public execBrowserModal():Promise<string>
    {
        return this.componentsFactory.getFileInputFactory().getBrowserModal().show();
    }

    public updateFileBrowser(icons:TFilesBrowserIcon[], path:string)
    {
        this.componentsFactory.getFileInputFactory().getBrowserModal().setCurrentPath(path);
        this.componentsFactory.getFileInputFactory().getBrowserModal().update(icons);
    }

    public execItemContextMenu(x:number, y:number, icon:TFilesBrowserIcon)
    {
        this.componentsFactory.getFileInputFactory().getFileContextMenu().show(x, y, icon);
    }

    public execItemModal(name:string = ''):Promise<string>
    {
        return new Promise<string>((resolve:any, reject:any)=>{
            let dirName = prompt('Имя', name);
            if(dirName){
                resolve(dirName);
            }else{
                reject();
            }
        });
    }

    public hideItemContextMenu()
    {
        this.componentsFactory.getFileInputFactory().getFileContextMenu().hide();
    }

    public deletedFile(path:string)
    {
        this.componentsFactory.getFileInputFactory().getBrowserModal().deleteFile(path);
    }

    public renamedFile(path:string, newName:string)
    {
        this.componentsFactory.getFileInputFactory().getBrowserModal().renameFile(path, newName);
    }

    public createdDir(path:string, name:string)
    {
        let dirData:TFilesBrowserIcon = {
            isDir: true,
            name: name,
            path: path
        }
        this.componentsFactory.getFileInputFactory().getBrowserModal().newItem(dirData);
    }

    public uploadedFile(path:string, name:string)
    {
        let fileData:TFilesBrowserIcon = {
            isDir: false,
            name: name,
            path: path
        }
        this.componentsFactory.getFileInputFactory().getBrowserModal().newItem(fileData);
    }

}