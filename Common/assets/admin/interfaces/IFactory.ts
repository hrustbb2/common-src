import {IFactory as IComponentsFactory} from './components/IFactory';
import {IFactory as IBusFactory} from './bus/IFactory';

export interface IFactory {
    getComponentsFactory():IComponentsFactory;
    getBusFactory():IBusFactory;
    initAdminPanel():void;
}