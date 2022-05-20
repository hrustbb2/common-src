import {TFilesBrowserIcon} from '../../../types/TFilesBrowserIcon';
import {IFilesBrowserCommands} from '../../../interfaces/commands/IFilesBrowserCommands';
import {IFileInputBus} from '../../../interfaces/bus/IFileInputBus';

export interface IItem {
    template:JQuery;
    getData():TFilesBrowserIcon;
    setFBCommands(commands:IFilesBrowserCommands):void;
    setFBBus(bus:IFileInputBus):void;
    setOnSelectedFile(callcack:(fileName:string)=>void):void;
    load(data:TFilesBrowserIcon):void;
    eventsListen():void;
    rename(name:string):void;
}