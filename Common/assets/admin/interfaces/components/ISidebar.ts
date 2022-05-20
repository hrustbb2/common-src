import {ISidebarMenu} from '../components/ISidebarMenu';

export interface ISidebar {
    setMenu(menu:ISidebarMenu):void;
    init(container:JQuery):void;
}