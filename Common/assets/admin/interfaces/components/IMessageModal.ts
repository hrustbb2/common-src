export interface IMessageModal {
    template:JQuery;
    show(header:string, message:string):void;
    eventListen():void;
}