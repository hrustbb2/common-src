import {IBox} from '../components/IBox';

export interface IContent {
    setBoxCreator(callback:()=>IBox):void;
    init(container:JQuery):void;
}