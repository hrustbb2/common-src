import {IFileInput} from '../../interfaces/components/file-input/IFileInput';
import {TValueObject} from '../../types/TValueObject';
import {IFileInputBus} from '../../interfaces/bus/IFileInputBus';
import 'jquery';

export class FileInput implements IFileInput {

    protected html:string = `
        <div class="object-field">
            <label class="form-label js-label"></label>
            <div class="input-group">
                <input type="text" class="form-control js-input">
                <div class="input-group-append">
                    <a href="#" class="input-group-text btn-info js-browser-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                            <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="invalid-feedback js-error-message"></div>
        </div>
    `;

    protected $template:JQuery;

    protected $label:JQuery;

    protected $input:JQuery;

    protected $browserBtn:JQuery;

    protected $errorMessage:JQuery;

    protected data:TValueObject;

    protected bus:IFileInputBus;

    protected formKey:string;

    public setFormKey(key:string)
    {
        this.formKey = key;
    }

    public setBus(bus:IFileInputBus)
    {
        this.bus = bus;
    }

    public constructor()
    {
        this.$template = $(this.html);
        this.$label = this.$template.find('.js-label');
        this.$input = this.$template.find('.js-input');
        this.$browserBtn = this.$template.find('.js-browser-btn');
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
        this.$input.val(data.value);
    }

    public showErrors()
    {
        if(this.data.errors.length){
            this.$input.addClass('is-invalid');
            this.$errorMessage.text(this.data.errors[0]);
            this.$errorMessage.css('display', 'block');
        }
    }

    public clearErrors()
    {
        this.$input.removeClass('is-invalid');
        this.$errorMessage.text('');
        this.$errorMessage.hide();
    }

    public serialize():TValueObject
    {
        return this.data;
    }

    public eventsListen()
    {
        this.$input.on('input', (e:Event)=>{
            let val = $(e.target).val();
            this.data.value = val;
        });
        this.$browserBtn.on('click', (e:Event)=>{
            e.preventDefault();
            this.bus.execBrowserModal()
                .then((fileName:string)=>{
                    this.data.value = fileName;
                    this.$input.val(fileName);
                });
        });
    }

}