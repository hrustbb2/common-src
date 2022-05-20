export interface IFilesBrowserCommands {
    getDir(path:string):Promise<any>;
    createDir(path:string):Promise<any>;
    deleteFile(path:string):Promise<any>;
    uploadFile(path:string, file:File):Promise<any>;
    renameFile(path:string, newPath:string):Promise<any>;
}