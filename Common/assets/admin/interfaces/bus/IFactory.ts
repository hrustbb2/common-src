import {IFactory as IAdminPanelFactory} from '../IFactory';
import {IAdminPanelBus} from './IAdminPanelBus';

export interface IFactory {
    setAdminPanelFactory(factory:IAdminPanelFactory):void;
    getAdminPanelBus():IAdminPanelBus;
}