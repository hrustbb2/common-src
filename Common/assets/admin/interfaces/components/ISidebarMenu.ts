import {ISidebarMenuItem} from '../components/ISidebarMenuItem';

export interface ISidebarMenu {
    setItemCreator(callback:()=>ISidebarMenuItem):void;
    init(container:JQuery):void;
}