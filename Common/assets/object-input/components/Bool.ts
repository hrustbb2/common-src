import {TValueObject} from '../types/TValueObject';
import {IValueObject} from '../interfaces/components/IValueObject';
import 'jquery';

export class Bool implements IValueObject {

    protected html:string = `
        <div class="object-field form-check">
            <input class="form-check-input js-input" type="checkbox" id="">
            <label class="form-check-label js-label" for=""></label>
            <div class="invalid-feedback js-error-message"></div>
        </div>
    `;

    protected $template:JQuery;

    protected $label:JQuery;

    protected $input:JQuery;

    protected $errorMessage:JQuery;

    protected data:TValueObject;

    protected formKey:string;

    public setFormKey(key:string)
    {
        this.formKey = key;
    }

    public constructor()
    {
        this.$template = $(this.html);
        let id = Symbol();
        this.$label = this.$template.find('.js-label');
        this.$label.attr('for', id.toString());
        this.$input = this.$template.find('.js-input');
        this.$input.attr('id', id.toString());
        this.$errorMessage = this.template.find('.js-error-message');
    }

    public get template():JQuery
    {
        return this.$template;
    }

    public loadData(data:TValueObject)
    {
        this.data = data;
        this.$label.text(data.description);
        this.$input.prop('checked', data.value);
    }

    public showErrors()
    {
        if(this.data.errors.length){
            this.$input.addClass('is-invalid');
            this.$errorMessage.text(this.data.errors[0]);
        }
    }

    public clearErrors()
    {
        this.$input.removeClass('is-invalid');
        this.$errorMessage.text('');
    }

    public serialize():TValueObject
    {
        return this.data;
    }

    public eventsListen()
    {
        this.$input.on('input', (e:Event)=>{
            let val = $(e.target).prop('checked');
            this.data.value = val;
        });
    }

}