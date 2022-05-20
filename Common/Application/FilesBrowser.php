<?php

namespace Src\Common\Application;

use Exception;
use Src\Common\Interfaces\Application\IFilesBrowser;
use \SplFileInfo;
use \Throwable;

class FilesBrowser implements IFilesBrowser {

    protected $rootDir = './';

    public function init(array $conf = []): void
    {
        
    }

    public function setRootDir(string $rootDir):void
    {
        $this->rootDir = $rootDir;
    }

    public function scanDir(string $path):array
    {
        $files = scandir($this->rootDir . $path);
        $result = [];
        $path = $this->canonicalizePath($path);
        foreach($files as $file){
            $result[] = [
                'name' => $file,
                'path' => $path,
                'isDir' => is_dir($this->rootDir . $path . '/' . $file),
            ];
        }
        return $result;
    }

    public function createDir(string $path):array
    {
        try{
            $path = $this->canonicalizePath($this->rootDir . $path);
            $path = escapeshellarg($path);
            exec("mkdir -p $path");
            return [
                'success' => true,
            ];
        }catch(Throwable $e){
            return [
                'success' => false,
            ];
        }
    }

    public function renameFile(string $path, string $newPath):array
    {
        try{
            $path = $this->canonicalizePath($this->rootDir . $path);
            $newPath = $this->canonicalizePath($this->rootDir . $newPath);
            rename($path, $newPath);
            return [
                'success' => true,
            ];
        }catch(Throwable $e){
            return [
                'success' => false,
            ];
        }
    }

    public function deleteFile(string $path):array
    {
        try{
            $path = $this->canonicalizePath($this->rootDir . $path);
            if(is_dir($path)){
                $path = escapeshellarg($path);
                exec("rm -r $path");
            }else{
                unlink($path);
            }
            return [
                'success' => true,
            ];
        }catch(Throwable $e){
            return [
                'success' => false,
            ];
        }
    }

    public function uploadFile(string $path, SplFileInfo $file):array
    {
        try{
            $path = $this->canonicalizePath($this->rootDir . $path);
            $fileName = basename($path);
            if(!move_uploaded_file($file->getRealPath(), $path)){
                throw new Exception();
            }
            return [
                'success' => true,
                'fileName' => $fileName,
            ];
        }catch(Throwable $e){
            return [
                'success' => false,
            ];
        }
    }

    private function canonicalizePath($path)
    {
        $path = explode('/', $path);
        $stack = array();
        foreach ($path as $k=>$seg) {
            if($seg == '' && $k>0){
                continue;
            }
            
            if ($seg == '..') {
                // Ignore this segment, remove last segment from stack
                array_pop($stack);
                continue;
            }

            if ($seg == '.') {
                // Ignore this segment
                continue;
            }

            $stack[] = $seg;
        }

        return implode('/', $stack);
    }

}