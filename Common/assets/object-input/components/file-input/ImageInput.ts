import {IFileInputBus} from '../../interfaces/bus/IFileInputBus';
import {TImageObject} from '../../types/TImageObject';
import {IImageInput} from '../../interfaces/components/file-input/IImageInput';
import 'jquery';

export class ImageInput implements IImageInput {

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
            <div class="prev-container">
                <canvas class="img-prev js-canvas"></canvas>
                <div class="preloader js-preloader">
                    <div class="lds-dual-ring"></div>
                </div>
            </div>
        </div>
    `;

    protected $template:JQuery;

    protected $label:JQuery;

    protected $input:JQuery;

    protected $browserBtn:JQuery;

    protected $errorMessage:JQuery;

    protected $prevImg:JQuery;

    protected $preloader:JQuery;

    protected data:TImageObject;

    protected bus:IFileInputBus;

    protected formKey:string;

    protected canvasContext:any;

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
        this.$preloader = this.template.find('.js-preloader');
        this.$prevImg = this.template.find('.js-canvas');
        this.canvasContext = (<any>this.$prevImg.get(0)).getContext('2d');
    }

    public get template():JQuery
    {
        return this.$template;
    }

    public loadData(data:TImageObject)
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

    public serialize():TImageObject
    {
        return this.data;
    }

    public eventsListen()
    {
        let w = this.$template.width();
        this.$prevImg.attr('width', w);
        if(this.data.ar){
            let h = w / this.data.ar;
            this.$prevImg.attr('height', h);
        }else{
            this.$prevImg.attr('height', w);
        }
        if(this.data.value){
            this.previewImg(this.data.value);
        }
        
        this.$input.on('input', (e:Event)=>{
            let val = <string>$(e.target).val();
            this.data.value = val;
            this.previewImg(val);
        });
        this.$browserBtn.on('click', (e:Event)=>{
            e.preventDefault();
            this.bus.execBrowserModal()
                .then((fileName:string)=>{
                    this.data.value = fileName;
                    this.$input.val(fileName);
                    this.previewImg(fileName);
                });
        });
    }

    protected previewImg(fileName:string)
    {
        let canvasWidth = this.$prevImg.attr('width');
        let canvasHeight = this.$prevImg.attr('height');
        let img = new Image();
        this.$preloader.show();
        img.onload = ()=>{
            this.canvasContext.clearRect(0, 0, canvasWidth, canvasHeight);
            let imgH = img.height;
            let imgW = img.width;
            if(this.data.ar == 0){
                this.canvasContext.drawImage(img, 0, 0, imgW, imgH, 0, 0, canvasWidth, canvasHeight);
                this.$preloader.hide();
                return;
            }
            let dx = 0; let dy = 0;
            if(imgW / imgH > this.data.ar){
                // изображение вытянуто по ширине
                let scale = imgH / +canvasHeight;
                dx = (imgW - +canvasWidth * scale) / 2;
            }else{
                // изображение вытянуто по высоте
                let scale = imgW / +canvasWidth;
                dy = (imgH - +canvasHeight * scale) / 2;
            }
            this.canvasContext.drawImage(img, dx, dy, imgW - 2*dx, imgH - 2*dy, 0, 0, canvasWidth, canvasHeight);
            this.$preloader.hide();
        }
        img.src = this.data.path + fileName;
    }

}