import {IMessageModal} from '../interfaces/components/IMessageModal';

export class MessageModal implements IMessageModal {

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
                        <button type="button" class="btn btn-primary js-ok-button">OK</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    private $template:JQuery;

    private $title:JQuery;

    private $body:JQuery;

    private $okButton:JQuery;

    get template():JQuery
    {
        return this.$template;
    }

    public constructor()
    {
        this.$template = $(this.html);
        this.$title = this.$template.find('.js-title');
        this.$body = this.$template.find('.js-body');
        this.$okButton = this.$template.find('.js-ok-button');
    }

    public eventListen()
    {
        this.$okButton.on('click', ()=>{
            (<any>this.$template).modal('hide');
        });
    }

    public show(header:string, message:string)
    {
        (<any>this.$template).modal('show');
        this.$title.text(header);
        this.$body.text(message);
    }

}