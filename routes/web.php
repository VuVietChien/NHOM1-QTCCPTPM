<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\NewsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('category')->name('category.')->group(function () {
    Route::get('', [CategoryController::class, 'index'])->name('index');
    Route::get('create', [CategoryController::class, 'create'])->name('create');
    Route::post('store', [CategoryController::class, 'store'])->name('store');
    Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');
});
Route::prefix('news')->name('news.')->group(function () {
    Route::get('', [NewsController::class, 'index'])->name('index');
    Route::get('create', [NewsController::class, 'create'])->name('create');
    Route::post('store', [NewsController::class, 'store'])->name('store');
    Route::get('delete/{id}', [NewsController::class, 'delete'])->name('delete');
    Route::get('edit/{id}', [NewsController::class, 'edit'])->name('edit');
    Route::post('update/{id}', [NewsController::class, 'update'])->name('update');
});
#Product
Route::resource('products', ProductController::class);
#Upload
Route::post('upload/services',[UploadController::class,'store']);
/**
 * CKEditor
 **/
Route::post('ckeditor/upload', [\App\Http\Controllers\CKEditorController::class, 'upload'])->name('ckeditor.image-upload');


