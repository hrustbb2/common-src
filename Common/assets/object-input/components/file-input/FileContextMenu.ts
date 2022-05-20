import {IFileContextMenu} from '../../interfaces/components/file-input/IFileContextMenu';
import {TFilesBrowserIcon} from '../../types/TFilesBrowserIcon';
import {IFilesBrowserCommands} from '../../interfaces/commands/IFilesBrowserCommands';
import {IFileInputBus} from '../../interfaces/bus/IFileInputBus';
import 'jquery';

export class FileContextMenu implements IFileContextMenu {

    protected html:string = `
        <div class="fb-context-menu">
            <div class="fb-context-menu-item js-rename-button">
                Переименовать
            </div>
            <div class="fb-context-menu-item js-delete-button">
                Удалить
            </div>
        </div>
    `;

    protected $template:JQuery;

    protected $renameButton:JQuery;

    protected $deleteButton:JQuery;

    protected fileBrowserCommands:IFilesBrowserCommands;

    protected fileBrowserBus:IFileInputBus;

    protected data:TFilesBrowserIcon;

    public setFilesBrowserCommands(commands:IFilesBrowserCommands)
    {
        this.fileBrowserCommands = commands;
    }

    public setFileBrowserBus(bus:IFileInputBus)
    {
        this.fileBrowserBus = bus;
    }

    public constructor()
    {
        this.$template = $(this.html);
        this.$renameButton = this.$template.find('.js-rename-button');
        this.$deleteButton = this.$template.find('.js-delete-button');
    }

    public get template():JQuery
    {
        return this.$template;
    }

    public eventsListen()
    {
        this.$deleteButton.on('click', (e:Event)=>{
            if(confirm('Удалить ' + this.data.name + '?')){
                this.fileBrowserCommands.deleteFile(this.data.path + '/' + this.data.name)
                    .then((resp:any)=>{
                        if(resp.success){
                            this.fileBrowserBus.deletedFile(this.data.path + '/' + this.data.name);
                        }
                    });
                this.hide();
            }
        });
        this.$renameButton.on('click', (e:Event)=>{
            let newName = '';
            this.fileBrowserBus.execItemModal(this.data.name)
                .then((name:string)=>{
                    newName = name;
                    return this.fileBrowserCommands.renameFile(this.data.path + '/' + this.data.name, this.data.path + '/' + name);
                })
                .then((resp:any)=>{
                    if(resp.success){
                        this.fileBrowserBus.renamedFile(this.data.path + '/' + this.data.name, newName);
                    }
                });
            this.hide();
        });
    }

    public show(x:number, y:number, data:TFilesBrowserIcon)
    {
        this.data = data;
        this.$template.css({top: y, left: x});
        this.$template.show();
    }

    public hide()
    {
        this.$template.hide();
    }

}