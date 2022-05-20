import {IConfirmModal} from '../interfaces/components/IConfirmModal';
import 'jquery';
import 'bootstrap';

export class ConfirmModal implements IConfirmModal {

    private html:string = `
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title js-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body js-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary js-yes-button">Да</button>
                        <button type="button" class="btn btn-primary js-no-button">Нет</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    private $template:JQuery;

    private $title:JQuery;

    private $body:JQuery;

    private $yesButton:JQuery;

    private $noButton:JQuery;

    private resolve:any;

    private reject:any;

    get template():JQuery
    {
        return this.$template;
    }

    public constructor()
    {
        this.$template = $(this.html);
        this.$title = this.$template.find('.js-title');
        this.$body = this.$template.find('.js-body');
        this.$yesButton = this.$template.find('.js-yes-button');
        this.$noButton = this.$template.find('.js-no-button');
    }

    public eventListen()
    {
        this.$yesButton.on('click', ()=>{
            (<any>this.$template).modal('hide');
            this.resolve();
        });
        this.$noButton.on('click', ()=>{
            (<any>this.$template).modal('hide');
            this.reject();
        });
    }

    public show(header:string, message:string):Promise<any>
    {
        (<any>this.$template).modal('show');
        this.$title.text(header);
        this.$body.text(message);
        return new Promise<any>((resolve:any, reject:any)=>{
            this.reject = reject;
            this.resolve = resolve;
        });
    }
}