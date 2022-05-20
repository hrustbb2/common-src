import {ISidebar} from '../components/ISidebar';
import {IHeader} from '../components/IHeader';
import {IContent} from '../components/IContent';

export interface IAdminPanel {
    setSidebar(sidebar:ISidebar):void;
    setHeader(header:IHeader):void;
    setContent(content:IContent):void;
    init(container:JQuery):void;
    header:IHeader;
    sidebar:ISidebar;
    content:IContent;
    toggleSidebar():void;
    collapseSidebar():void;
}