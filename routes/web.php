<?php

use App\Http\Controllers\BackControllers\HomeControllerBack;
use App\Http\Controllers\EvenementCollecteController;
use App\Http\Controllers\FrontControllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackControllers\cd;

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


Route::resource('evenement_collectes', EvenementCollecteController::class);
Route::get('/evenement_collectes/create', [EvenementCollecteController::class, 'create'])->name('evenement_collectes.create');
Route::post('/evenement_collectes', [EvenementCollecteController::class, 'store'])->name('evenement_collectes.store');

Route::get('/centers/{id}', [CenterController::class, 'showDetails'])->name('center.show.details');
Route::get('/center', [CenterController::class, 'index'])->name('center.index');
Route::get('/centers', [CenterController::class, 'showCenters'])->name('centers.index');
Route::resource('/center',CenterController::class);
/////routees for sondages entity
Route::resource('/sondage', \App\Http\Controllers\BackControllers\SondageController::class)->names([
    'index' => 'sondage.index',
    'create' => 'sondage.create.form',
    'store' => 'sondage.store',

]);
Route::resource('/polls', \App\Http\Controllers\FrontControllers\SondageFrontController::class)->names([
    'index' => 'sondage.listing',
'show'=>'sondage.details',
]);




