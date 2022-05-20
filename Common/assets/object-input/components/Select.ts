import {TSelectObject} from '../types/TSelectObject';
import {IValueObject} from '../interfaces/components/IValueObject';
import 'jquery';

export class Select implements IValueObject {

    protected html:string = `
        <div class="object-field">
            <label class="form-label js-label"></label>
            <select class="form-control js-select">
                
            </select>
            <div class="invalid-feedback js-error-message"></div>
        </div>
    `;

    protected $template:JQuery;

    protected $label:JQuery;

    protected $select:JQuery;

    protected $errorMessage:JQuery;

    protected data:TSelectObject;

    protected formKey:string;

    public setFormKey(key:string)
    {
        this.formKey = key;
    }

    public constructor()
    {
        this.$template = $(this.html);
        this.$label = this.$template.find('.js-label');
        this.$select = this.$template.find('.js-select');
        this.$errorMessage = this.template.find('.js-error-message');
    }

    public get template():JQuery
    {
        return this.$template;
    }

    public loadData(data:TSelectObject)
    {
        this.data = data;
        this.$label.text(data.description);
        this.$select.val(data.value);
        this.$select.empty();
        for(let option of data.options){
            let isSelected = (data.value == option.value) ? 'selected' : '';
            let opt = $('<option value="' + option.value + '" ' + isSelected + '>' + option.title + '</option>');
            this.$select.append(opt);
        }
    }

    public showErrors()
    {
        if(this.data.errors.length){
            this.$select.addClass('is-invalid');
            this.$errorMessage.text(this.data.errors[0]);
        }
    }

    public clearErrors()
    {
        this.$select.removeClass('is-invalid');
        this.$errorMessage.text('');
    }

    public serialize():TSelectObject
    {
        return this.data;
    }

    public eventsListen()
    {
        this.$select.on('input', (e:Event)=>{
            let val = $(e.target).val();
            this.data.value = val;
        });
    }

}