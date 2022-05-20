import {IItem} from '../../interfaces/components/file-input/IItem';
import {TFilesBrowserIcon} from '../../types/TFilesBrowserIcon';
import {IFilesBrowserCommands} from '../../interfaces/commands/IFilesBrowserCommands';
import {IFileInputBus} from '../../interfaces/bus/IFileInputBus';
import 'jquery';

export class Item implements IItem {

    protected dirHtml:string = `
        <div class="fb-item">
            <div class="fb-item-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                    <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                </svg>
            </div>
            <div class="fb-item-name js-name">
            </div>
        </div>
    `;

    protected itemHtml:string = `
        <div class="fb-item">
            <div class="fb-item-icon">
                <svg width="40" height="40" viewBox="0 0 16 16" class="bi bi-card-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path fill-rule="evenodd" d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </div>
            <div class="fb-item-name js-name">
            </div>
        </div>
    `;

    protected $template:JQuery;

    protected $name:JQuery;

    protected commands:IFilesBrowserCommands;

    protected bus:IFileInputBus;

    protected data:TFilesBrowserIcon;

    protected selectFile:(fileName:string)=>void;

    public setFBCommands(commands:IFilesBrowserCommands)
    {
        this.commands = commands;
    }

    public setFBBus(bus:IFileInputBus):void
    {
        this.bus = bus;
    }

    public setOnSelectedFile(callcack:(fileName:string)=>void)
    {
        this.selectFile = callcack;
    }

    get template():JQuery
    {
        return this.$template;
    }

    public load(data:TFilesBrowserIcon)
    {
        this.data = data;
        if(data.isDir){
            this.$template = $(this.dirHtml);
        }else{
            this.$template = $(this.itemHtml);
        }
        this.$name = this.$template.find('.js-name');
        this.$name.text(data.name);
    }

    public rename(name:string)
    {
        this.data.name = name;
        this.$name.text(name);
    }

    public getData():TFilesBrowserIcon
    {
        return this.data;
    }

    public eventsListen()
    {
        this.$template.on('click', (e:Event)=>{
            e.preventDefault();
            if(this.data.isDir){
                this.openDir();
            }else{
                this.selectFile(this.data.path + '/' + this.data.name);
            }
        });
        this.template.on('contextmenu', (e:JQuery.Event)=>{
            e.preventDefault();
            this.bus.execItemContextMenu(e.pageX, e.pageY, this.data);
        });
    }

    protected openDir()
    {
        this.commands.getDir(this.data.path + '/' + this.data.name)
            .then((resp:TFilesBrowserIcon[])=>{
                this.bus.updateFileBrowser(resp, this.data.path + '/' + this.data.name);
            });
    }

}