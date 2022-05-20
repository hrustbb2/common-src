import {IComposite} from '../interfaces/components/IComposite';
import {IAbstractObject} from '../interfaces/components/IAbstractObject';
import {IObjectBus} from '../interfaces/bus/IObjectBus';
import {TComposite} from '../types/TComposite';
import {EInputTypes} from '../types/EInputTypes';

type TFields = {
    [field:string]:IAbstractObject;
}

export class Composite implements IComposite {

    protected html:string = `
        <div>
            <div class="js-body"></div>
            <div class="object-field">
                <button class="btn btn-info btn-sm js-save-button" style="display:none">Save</button>
                <button class="btn btn-secondary btn-sm js-back-button" style="display:none">Back</button>
            </div>
        </div>
    `;

    protected collapsedHtml:string = `
        <div class="object-field">
            <button class="btn btn-info">Obj</button>
        </div>
    `;

    protected $template:JQuery;

    protected $collapsedTemplate:JQuery;

    protected $body:JQuery;

    protected $backButton:JQuery;

    protected $saveButton:JQuery;
    
    protected data:TComposite;

    protected objectBus:IObjectBus;

    protected fields:TFields = {};

    protected resolve:any;

    protected reject:any;

    protected fieldCreator:(type:EInputTypes)=>IAbstractObject;

    protected formKey:string;

    public setFormKey(key:string)
    {
        this.formKey = key;
    }

    public constructor()
    {
        this.$template = $(this.html);
        this.$body = this.$template.find('.js-body');
        this.$backButton = this.$template.find('.js-back-button');
        this.$saveButton = this.$template.find('.js-save-button');
        this.$collapsedTemplate = $(this.collapsedHtml);
    }

    public get template():JQuery
    {
        return this.$template;
    }

    public get collapsedTemplate():JQuery
    {
        return this.$collapsedTemplate;
    }

    public setFieldCreator(callback:(type:EInputTypes)=>IAbstractObject)
    {
        this.fieldCreator = callback;
    }

    public setObjectBus(bus:IObjectBus)
    {
        this.objectBus = bus;
    }

    public loadData(data:TComposite):void
    {
        this.data = data;
        for(let name in data.fields){
            let field = this.fieldCreator(data.fields[name].type);
            field.setFormKey(this.formKey);
            field.loadData(data.fields[name]);
            this.fields[name] = field;
        }
        this.showErrors();
    }

    public getData():TComposite
    {
        return this.data;
    }
    
    public build():Promise<TComposite>
    {
        return new Promise<TComposite>((resolve:any, reject:any)=>{
            this.resolve = resolve;
            this.reject = reject;
            this.draw();
        });
    }

    public draw(): void
    {
        this.$body.empty();
        for(let name in this.fields){
            if(this.fields[name].serialize().composite){
                this.$body.append((<IComposite>this.fields[name]).collapsedTemplate);
                continue;
            }
            this.$body.append(this.fields[name].template);
        }
    }

    public showSaveButton()
    {
        this.$saveButton.show();
    }

    public showBackButton()
    {
        this.$backButton.show();
    }

    public showErrors():void
    {
        if(this.data.errors.length){
            this.$collapsedTemplate.removeClass('btn-info');
            this.$collapsedTemplate.addClass('btn-danger');
        }

        for(let name in this.fields){
            this.fields[name].showErrors();
        }
    }

    public clearErrors():void
    {

    }

    public serialize():TComposite
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
        for(let name in this.fields){
            this.fields[name].eventsListen();
        }
        this.$collapsedTemplate.on('click', (e:Event)=>{
            e.preventDefault();
            this.objectBus.renderForm(this.deepClone(this.data), this.formKey)
                .then((updatedObj:TComposite)=>{
                    this.data.fields = updatedObj.fields;
                    this.objectBus.back(this.formKey);
                });
        });
        this.$backButton.on('click', (e:Event)=>{
            e.preventDefault();
            this.objectBus.back(this.formKey);
        });
        this.$saveButton.on('click', (e:Event)=>{
            e.preventDefault();
            this.resolve(this.data);
        });
    }

}