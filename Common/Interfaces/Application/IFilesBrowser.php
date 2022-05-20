<?php

namespace Src\Common\Interfaces\Application;

use \SplFileInfo;

interface IFilesBrowser {
    public function init(array $conf = []): void;
    public function setRootDir(string $rootDir):void;
    public function createDir(string $path):array;
    public function scanDir(string $path):array;
    public function renameFile(string $path, string $newPath):array;
    public function deleteFile(string $path):array;
    public function uploadFile(string $path, SplFileInfo $file):array;
}