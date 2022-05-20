import {IFilesBrowserCommands} from '../interfaces/commands/IFilesBrowserCommands';
import {TSettings} from '../types/TSettings';
import 'jquery';

declare let settings:TSettings;

export class FilesBrowserCommands implements IFilesBrowserCommands {

    public getDir(path:string):Promise<any>
    {
        return new Promise<any>((resolve:any, reject:any)=>{
            let formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('path', path);
            
            $.ajax({
                url: settings.fileInputSettings.getDirUrl,
                data: formData,
                type: 'POST',
                dataType: 'json',
                processData : false,
                contentType : false,
                success: (resp:any) => {
                    resolve(resp);
                },
                error: (e:JQueryXHR) => {
                    reject(e.responseJSON);
                }
            });
        });
    }

    public createDir(path:string):Promise<any>
    {
        return new Promise<any>((resolve:any, reject:any)=>{
            let formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('path', path);
            
            $.ajax({
                url: settings.fileInputSettings.createDirUrl,
                data: formData,
                type: 'POST',
                dataType: 'json',
                processData : false,
                contentType : false,
                success: (resp:any) => {
                    resolve(resp);
                },
                error: (e:JQueryXHR) => {
                    reject(e.responseJSON);
                }
            });
        });
    }

    public deleteFile(path:string):Promise<any>
    {
        return new Promise<any>((resolve:any, reject:any)=>{
            let formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('path', path);

            $.ajax({
                url: settings.fileInputSettings.deleteFileUrl,
                data: formData,
                type: 'POST',
                dataType: 'json',
                processData : false,
                contentType : false,
                success: (resp:any) => {
                    resolve(resp);
                },
                error: (e:JQueryXHR) => {
                    reject(e.responseJSON);
                }
            });
        });
    }

    public uploadFile(path:string, file:File):Promise<any>
    {
        return new Promise<any>((resolve:any, reject:any)=>{
            let formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('path', path);
            formData.append('file', file);
            
            $.ajax({
                url: settings.fileInputSettings.uploadFileUrl,
                data: formData,
                type: 'POST',
                dataType: 'json',
                processData : false,
                contentType : false,
                success: (resp:any) => {
                    resolve(resp);
                },
                error: (e:JQueryXHR) => {
                    reject(e.responseJSON);
                }
            });
        });
    }

    public renameFile(path:string, newPath:string):Promise<any>
    {
        return new Promise<any>((resolve:any, reject:any)=>{
            let formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('path', path);
            formData.append('new_path', newPath);

            $.ajax({
                url: settings.fileInputSettings.renameFileUrl,
                data: formData,
                type: 'POST',
                dataType: 'json',
                processData : false,
                contentType : false,
                success: (resp:any) => {
                    resolve(resp);
                },
                error: (e:JQueryXHR) => {
                    reject(e.responseJSON);
                }
            });
        });
    }

}