import {IFactory as IAdminPanelFactory} from '../IFactory';
import {IAdminPanel} from './IAdminPanel';
import {IConfirmModal} from './IConfirmModal';
import {IMessageModal} from './IMessageModal';
import 'jquery';

export interface IFactory {
    initAdminPanel():void;
    setAdminPanelFactory(factory:IAdminPanelFactory):void;
    getAdminPanel():IAdminPanel;
    getConfirmModal():IConfirmModal;
    getMessageModal():IMessageModal;
}