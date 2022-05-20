import {IBox} from '../interfaces/components/IBox';
import 'jquery';

export class Box implements IBox {

    private $container:JQuery;

    private $title:JQuery;

    private $collapseButton:JQuery;

    private $removeButton:JQuery;

    private $body:JQuery;

    private isCollapsed:boolean = false;

    public get element():JQuery
    {
        return this.$container;
    }

    public init(container:JQuery)
    {
        this.$container = container;
        this.$title = this.$container.find('.js-box-title');
        this.$collapseButton = this.$container.find('.js-collapse-button');
        this.$removeButton = this.$container.find('.js-remove-button');
        this.$body = this.$container.find('.js-box-body');
        let collapse = this.$container.attr('collapse');
        if(collapse == 'true'){
            this.isCollapsed = true;
        }
        this.eventListen();
    }

    private eventListen(){
        this.$removeButton.off();
        this.$removeButton.on('click', this.onRemoveButtonClick.bind(this));
        this.$collapseButton.off();
        this.$collapseButton.on('click', this.onCollapseButtonClick.bind(this));
    }

    private onRemoveButtonClick(event:Event)
    {
        this.$container.remove();
    }

    private onCollapseButtonClick(event:Event)
    {
        let icon = this.$collapseButton.find('i');
        if(this.isCollapsed){
            this.isCollapsed = false;
            this.$body.slideDown(500);
            icon.removeClass('fa-plus');
            icon.addClass('fa-minus');
        }else{
            this.isCollapsed = true;
            this.$body.slideUp(500);
            icon.removeClass('fa-minus');
            icon.addClass('fa-plus');
        }
    }

    public setTitle(title:string):void
    {
        this.$title.text(title);
    }
}