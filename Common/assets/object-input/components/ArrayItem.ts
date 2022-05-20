import {IArrayItem} from '../interfaces/components/IArrayItem';
import {TAbstractObject} from '../types/TAbstractObject';
import {TValueObject} from '../types/TValueObject';
import {TComposite} from '../types/TComposite';
import {IObjectBus} from '../interfaces/bus/IObjectBus';

export class ArrayItem implements IArrayItem {

    protected html:string = `
        <button class="btn btn-info mt-1">
            <span class="js-label"></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="js-remove-btn bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
            </svg>
        </button>
    `;
    
    protected $template:JQuery;

    protected $label:JQuery;

    protected $removeBtn:JQuery;

    protected data:TAbstractObject;

    protected objectBus:IObjectBus;

    protected onDelete:(item:TAbstractObject)=>void;

    protected onUpdated:(item:TAbstractObject)=>void;

    protected onDragStarted:(item:IArrayItem)=>void;

    protected onDragMove:(x:number, y:number)=>void;

    protected onDragEnded:(item:IArrayItem)=>void;

    protected index:number;

    protected isDragStarted:boolean;

    protected formKey:string;

    public setFormKey(key:string)
    {
        this.formKey = key;
    }

    public constructor()
    {
        this.$template = $(this.html);
        this.$label = this.$template.find('.js-label');
        this.$removeBtn = this.$template.find('.js-remove-btn');
    }

    public get template():JQuery
    {
        return this.$template;
    }

    public setObjectBus(bus:IObjectBus)
    {
        this.objectBus = bus;
    }

    public setOnDelete(callbck:(item:TAbstractObject)=>void)
    {
        this.onDelete = callbck;
    }

    public setOnUpdated(callback:(item:TAbstractObject)=>void)
    {
        this.onUpdated = callback;
    }

    public setOnDragStarted(callback:(item:IArrayItem)=>void)
    {
        this.onDragStarted = callback;
    }

    public setOnDragMove(callback:(x:number, y:number)=>void)
    {
        this.onDragMove = callback;
    }

    public setOnDragEnded(callback:(item:IArrayItem)=>void)
    {
        this.onDragEnded = callback;
    }

    public setIndex(index:number)
    {
        this.index = index;
    }

    public getIndex():number
    {
        return this.index;
    }

    public getData():TAbstractObject
    {
        return this.data;
    }

    public loadData(data:TAbstractObject):void
    {
        this.data = data;
        if(this.data.composite){
            this.$label.text(data.description);
        }else{
            this.$label.text((<TValueObject>data).value);
        }
    }

    public setLabel(label:string)
    {
        this.$label.text(label);
    }

    public showErrors():void
    {
        if(this.data.errors.length){
            this.$template.removeClass('btn-info');
            this.$template.addClass('btn-danger');
        }
    }

    public clearErrors():void
    {
        this.$template.removeClass('btn-danger');
        this.$template.addClass('btn-info');
    }

    public serialize():TAbstractObject
    {
        return this.data;
    }

    protected deepClone(obj:any)
    {
        if(Array.isArray(obj)){
            let result:any[] = [];
            for(let item of obj){
                if(typeof item === 'object'){
                    result.push(this.deepClone(item));
                }else{
                    result.push(item);
                }
            }
            return result;
        }else{
            let result:any = {};
            for(let key in obj){
                if(typeof obj[key] === 'object' && obj[key] !== null && key !== 'container'){
                    result[key] = this.deepClone(obj[key]);
                }else{
                    result[key] = obj[key];
                }
            }
            return result;
        }
    }

    public eventsListen()
    {
        this.$template.off();
        this.$removeBtn.off();
        this.$removeBtn.on('mousedown', (event:Event)=>{
            event.stopPropagation();
            this.onDelete(this.data);
        });
        let draggable = true;
        this.$template.on('mousedown', (event:Event)=>{
            setTimeout(()=>{
                if(draggable){
                    this.isDragStarted = true;
                    this.startDrag(event);
                }
            }, 200);
        });
        this.$template.on('mouseup', (event:Event)=>{
            if(!this.isDragStarted){
                this.onClick(event);
                draggable = false;
            }else{
                if(this.onDragEnded){
                    this.onDragEnded(this);
                }
            }
            this.isDragStarted = false;
        });
        $('body').on('mousemove', (event:Event)=>{
            if(this.isDragStarted){
                this.$template[0].style.left = (<MouseEvent>event).pageX - this.$template[0].offsetWidth / 2 + 'px';
                this.$template[0].style.top = (<MouseEvent>event).pageY - this.$template[0].offsetHeight / 2 + 'px';
                if(this.onDragMove){
                    this.onDragMove((<MouseEvent>event).pageX, (<MouseEvent>event).pageY);
                }
            }
        });
    }

    protected startDrag(event:Event)
    {
        this.$template.css('position', 'absolute');
        $('body').append(this.$template);
        this.$template[0].style.zIndex = '1000';
        this.$template[0].style.left = (<MouseEvent>event).pageX - this.$template[0].offsetWidth / 2 + 'px';
        this.$template[0].style.top = (<MouseEvent>event).pageY - this.$template[0].offsetHeight / 2 + 'px';
        if(this.onDragStarted){
            this.onDragStarted(this);
        }
    }

    protected onClick(event:Event)
    {
        event.preventDefault();
        if(this.data.composite){
            this.objectBus.renderForm(<TComposite>this.deepClone(this.data), this.formKey)
                .then((updatedItem:TComposite)=>{
                    (<TComposite>this.data).fields = updatedItem.fields;
                    this.onUpdated(updatedItem);
                    this.objectBus.back(this.formKey);
                });
        }else{
            this.objectBus.execObjectModal(this.data)
                .then((updatedItem:TComposite)=>{
                    this.loadData(updatedItem);
                    this.onUpdated(updatedItem);
                    this.objectBus.rerender(this.formKey);
                });
        }
    }

}