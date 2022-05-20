import {IAdminPanelBus} from '../bus/IAdminPanelBus';

export interface IHeader {
    init(container:JQuery):void;
    setAdminPanelBus(bus:IAdminPanelBus):void;
}