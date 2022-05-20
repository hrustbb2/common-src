import {IContent} from '../interfaces/components/IContent';
import {IBox} from '../interfaces/components/IBox';
import 'jquery';

export class Content implements IContent {

    protected $container:JQuery;

    protected boxes:IBox[];

    protected boxCreator:()=>IBox;

    public setBoxCreator(callback:()=>IBox)
    {
        this.boxCreator = callback;
    }

    public init(container:JQuery)
    {
        this.$container = container;
        this.boxes = [];
        let boxElements = this.$container.find('.js-box');
        boxElements.each((i:number, el:HTMLElement)=>{
            let boxComponent = this.boxCreator();
            boxComponent.init($(el));
            this.boxes.push(boxComponent);
        });
    }

}