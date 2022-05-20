import {IFactory as IComponentsFactory} from '../components/IFactory';

export interface IAdminPanelBus {
    setComponentsFactory(factory:IComponentsFactory):void;
    toggleSidebar():void;
    collapseSidebar():void;
    execMessageModal(header:string, message:string):void;
    execConfirmModal(header:string, message:string):Promise<any>;
}