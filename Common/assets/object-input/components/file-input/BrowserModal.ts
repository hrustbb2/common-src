import {IBrowserModal} from '../../interfaces/components/file-input/IBrowserModal';
import {IFilesBrowserCommands} from '../../interfaces/commands/IFilesBrowserCommands';
import {IItem} from '../../interfaces/components/file-input/IItem';
import {IFileInputBus} from '../../interfaces/bus/IFileInputBus';
import {TFilesBrowserIcon} from '../../types/TFilesBrowserIcon';
import 'jquery';
import 'bootstrap';

export class BrowserModal implements IBrowserModal {

    protected html:string = `
        <div class="fb-modal modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body js-body">
                        <div class="files-container js-files-container"></div>
                    </div>
                    <div class="modal-footer">
                        <input type="file" id="fb-file-input" class="fb-file-input js-file-input" />
                        <label for="fb-file-input" class="btn btn-primary js-file-input-label">Upload</label>
                        <button type="button" class="btn btn-primary js-create-dir-button">Create dir</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    protected $template:JQuery;

    protected $body:JQuery;

    protected $jsContainer:JQuery;

    protected $createDirButton:JQuery;

    protected $fileInput:JQuery;

    protected filesBrowserCommands:IFilesBrowserCommands;

    protected icons:IItem[] = [];

    protected resolve:any;

    protected reject:any;

    protected bus:IFileInputBus;

    protected currentPath:string = '';

    protected createItem:()=>IItem;

    public setItemCreator(creator:()=>IItem)
    {
        this.createItem = creator;
    }

    public setFileInputBus(bus:IFileInputBus)
    {
        this.bus = bus;
    }

    public setCurrentPath(path:string)
    {
        let segments = path.split('/');
        let stack = [];
        for(let i in segments){
            if(segments[i] == '' && +i > 0){
                continue;
            }
            if (segments[i] == '..') {
                // Ignore this segment, remove last segment from stack
                stack.pop();
                continue;
            }
            if (segments[i] == '.') {
                // Ignore this segment
                continue;
            }
            stack.push(segments[i]);
        }
        this.currentPath = stack.join('/');
    }

    public constructor()
    {
        this.$template = $(this.html);
        this.$body = this.$template.find('.js-body');
        this.$jsContainer = this.$template.find('.js-files-container');
        this.$createDirButton = this.$template.find('.js-create-dir-button');
        this.$fileInput = this.$template.find('.js-file-input');
    }

    public get template():JQuery
    {
        return this.$template;
    }

    public setFilesBrowserCommands(commands:IFilesBrowserCommands)
    {
        this.filesBrowserCommands = commands;
    }

    public show():Promise<string>
    {
        return new Promise<string>((resolve:any, reject:any)=>{
            this.resolve = resolve;
            this.reject = reject;
            let items = this.filesBrowserCommands.getDir('')
                .then((resp:any)=>{
                    this.$jsContainer.empty();
                    this.icons = [];
                    for(let data of resp){
                        if(data.name == '.'){
                            continue;
                        }
                        this.newItem(data);
                    }
                });
            console.log(items);
            (<any>this.$template).modal('show');
        });
    }

    public hide()
    {
        (<any>this.$template).modal('hide');
    }

    public eventsListen()
    {
        this.$template.on('click', (e:Event)=>{
            this.bus.hideItemContextMenu();
        });
        this.$template.on('hide.bs.modal', (e:Event)=>{
            this.bus.hideItemContextMenu();
        });
        this.$createDirButton.on('click', (e:Event)=>{
            let dirName = '';
            this.bus.execItemModal()
                .then((name:string)=>{
                    dirName = name;
                    return this.filesBrowserCommands.createDir(this.currentPath + '/' + name);
                })
                .then((resp:any)=>{
                    if(resp.success){
                        this.bus.createdDir(this.currentPath, dirName);
                    }
                });
        });
        this.$fileInput.on('change', (e:Event)=>{
            e.preventDefault();
            if((<any>event.target).files.length >= 1 ){
                let file = (<any>event.target).files[0];
                this.filesBrowserCommands.uploadFile(this.currentPath + '/' + file.name, file)
                    .then((resp:any)=>{
                        if(resp.success){
                            this.bus.uploadedFile(this.currentPath, resp.fileName);
                        }
                    });
            }
        });
    }

    public update(icons:TFilesBrowserIcon[])
    {
        this.$jsContainer.empty();
        this.icons = [];
        for(let data of icons){
            if(data.name == '.'){
                continue;
            }
            this.newItem(data);
        }
    }

    public deleteFile(path:string)
    {
        for(let i in this.icons){
            if(this.icons[i].getData().path + '/' + this.icons[i].getData().name == path){
                this.icons[i].template.remove();
                this.icons.splice(+i, 1);
                break;
            }
        }
    }

    public renameFile(path:string, newName:string)
    {
        for(let i in this.icons){
            if(this.icons[i].getData().path + '/' + this.icons[i].getData().name == path){
                this.icons[i].rename(newName);
                break;
            }
        }
    }

    public newItem(data:TFilesBrowserIcon)
    {
        let item = this.createItem();
        item.setOnSelectedFile((fileName:string)=>{
            this.resolve(fileName);
            this.hide();
        });
        item.load(data);
        this.$jsContainer.append(item.template);
        item.eventsListen();
        this.icons.push(item);
    }

}