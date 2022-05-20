import {IFileInput} from './IFileInput';
import {IImageInput} from './IImageInput';
import {IBrowserModal} from './IBrowserModal';
import {IFactory as IComponentsFactory} from '../IFactory';
import {IFileContextMenu} from './IFileContextMenu';

export interface IFactory {
    setComponentsFactory(factory:IComponentsFactory):void;
    createFileInput():IFileInput;
    createImageInput():IImageInput;
    getBrowserModal():IBrowserModal;
    getFileContextMenu():IFileContextMenu;
}