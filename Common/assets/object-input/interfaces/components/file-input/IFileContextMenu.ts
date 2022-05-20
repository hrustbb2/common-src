import {TFilesBrowserIcon} from '../../../types/TFilesBrowserIcon';
import {IFilesBrowserCommands} from '../../commands/IFilesBrowserCommands';
import {IFileInputBus} from '../../bus/IFileInputBus';

export interface IFileContextMenu {
    template:JQuery;
    setFilesBrowserCommands(commands:IFilesBrowserCommands):void;
    setFileBrowserBus(bus:IFileInputBus):void;
    eventsListen():void;
    show(x:number, y:number, data:TFilesBrowserIcon):void;
    hide():void;
}