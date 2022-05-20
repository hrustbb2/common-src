<?php

/**
 * prefix admin/common
 * as admin.common.
 */

use Illuminate\Support\Facades\Route;
use Src\Common\Laravel\Controllers\FilesBrowserControllers;

Route::group(['middleware' => ['web'], 'as' => 'admin.common.', 'prefix' => 'admin/common'], function(){
    Route::post('/dir', [FilesBrowserControllers::class, 'dir'])->name('filesBrowser.dir');
    Route::post('/delete-file', [FilesBrowserControllers::class, 'deleteFile'])->name('filesBrowser.deleteFile');
    Route::post('/rename-file', [FilesBrowserControllers::class, 'renameFile'])->name('filesBrowser.renameFile');
    Route::post('/create-dir', [FilesBrowserControllers::class, 'createDir'])->name('filesBrowser.createDir');
    Route::post('/upload-file', [FilesBrowserControllers::class, 'uploadFile'])->name('filesBrowser.uploadFile');
});