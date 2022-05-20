export interface IConfirmModal {
    template:JQuery;
    show(header:string, message:string):Promise<any>;
    eventListen():void;
}