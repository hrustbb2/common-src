<?php

namespace Src\Common\Laravel\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Src\Common\Factory as CommonFactory;

class FilesBrowserControllers extends Controller {

    public function dir(Request $request)
    {
        $factory = new CommonFactory();
        $factory->init();
        $path = $request->get('path') ?? '';
        $path = ($this->isPathVerify($path)) ? $path : '';
        $factory->getFilesBrowser()->setRootDir(config('admin.filesBrowser.rootDir'));
        $resp = $factory->getFilesBrowser()->scanDir($path);
        return response()->json($resp);
    }

    public function createDir(Request $request)
    {
        $path = $request->get('path');
        if($this->isPathVerify($path)){
            $factory = new CommonFactory();
            $factory->init();
            $factory->getFilesBrowser()->setRootDir(config('admin.filesBrowser.rootDir'));
            $resp = $factory->getFilesBrowser()->createDir($path);
            return response()->json($resp);
        }
    }

    public function renameFile(Request $request)
    {
        $path = $request->get('path');
        $newPath = $request->get('new_path');
        if($this->isPathVerify($path) && $this->isPathVerify($newPath)){
            $factory = new CommonFactory();
            $factory->init();
            $factory->getFilesBrowser()->setRootDir(config('admin.filesBrowser.rootDir'));
            $resp = $factory->getFilesBrowser()->renameFile($path, $newPath);
            return response()->json($resp);
        }
    }

    public function deleteFile(Request $request)
    {
        $path = $request->get('path');
        if($this->isPathVerify($path)){
            $factory = new CommonFactory();
            $factory->init();
            $factory->getFilesBrowser()->setRootDir(config('admin.filesBrowser.rootDir'));
            $resp = $factory->getFilesBrowser()->deleteFile($path);
            return response()->json($resp);
        }
    }

    public function uploadFile(Request $request)
    {
        $path = $request->get('path') ?? '/';
        $file = $request->file('file');
        if($this->isPathVerify($path)){
            $factory = new CommonFactory();
            $factory->init();
            $factory->getFilesBrowser()->setRootDir(config('admin.filesBrowser.rootDir'));
            $resp = $factory->getFilesBrowser()->uploadFile($path, $file);
            return response()->json($resp);
        }
    }

    protected function isPathVerify($path)
    {
        $path = explode('/', $path);
        $stack = array();
        foreach ($path as $seg) {
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

        // return implode('/', $stack);
        return count($stack) > 0;
    }

}