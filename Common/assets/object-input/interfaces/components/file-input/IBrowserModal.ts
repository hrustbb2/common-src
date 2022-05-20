import {IFilesBrowserCommands} from '../../commands/IFilesBrowserCommands';
import {IItem} from './IItem';
import {IFileInputBus} from '../../bus/IFileInputBus';
import {TFilesBrowserIcon} from '../../../types/TFilesBrowserIcon';

export interface IBrowserModal {
    template:JQuery;
    setCurrentPath(path:string):void;
    setItemCreator(creator:()=>IItem):void;
    setFileInputBus(bus:IFileInputBus):void;
    setFilesBrowserCommands(commands:IFilesBrowserCommands):void;
    show():Promise<string>;
    hide():void;
    eventsListen():void;
    update(icons:TFilesBrowserIcon[]):void;
    deleteFile(path:string):void;
    renameFile(path:string, newName:string):void;
    newItem(data:TFilesBrowserIcon):void;
}