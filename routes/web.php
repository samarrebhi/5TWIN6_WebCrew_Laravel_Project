<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontControllers\HomeController;
use App\Http\Controllers\BackControllers\HomeControllerBack;
use App\Http\Controllers\BackControllers\BlogController;
use App\Http\Controllers\FrontControllers\BlogControllerFront;
use App\Http\Controllers\EvenementCollecteController;

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

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index'])->name('homepage');
Route::get('admin', [HomeControllerBack::class, 'index'])->name('admin.home');

Route::get('admin/listBlog', [BlogController::class, 'index'])->name('admin.listBlog');
Route::get('admin/createBlog', [BlogController::class, 'create'])->name('admin.createBlog');
Route::post('admin/store', [BlogController::class, 'store'])->name('admin.store');
Route::get('admin/listBlog/{blog}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
Route::put('admin/listBlog/{blog}', [BlogController::class, 'update'])->name('admin.blog.update');
Route::delete('admin/listBlog/{blog}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');

Route::get('home/blogs', [BlogControllerFront::class, 'indexFront'])->name('Front.Blog.list');




//Route::get('/evenement_collectes/create', [EvenementCollecteController::class, 'create'])->name('evenement_collectes.create');
//Route::get('/evenement_collectes/{id}', [EvenementCollecteController::class, 'show'])->name('evenement_collectes.show');


Route::resource('evenement_collectes', EvenementCollecteController::class);
