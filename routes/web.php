<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontControllers\HomeController;
use App\Http\Controllers\BackControllers\HomeControllerBack;

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


Route::resource('evenement_collectes', EvenementCollecteController::class);
Route::get('/evenement_collectes/create', [EvenementCollecteController::class, 'create'])->name('evenement_collectes.create');
Route::post('/evenement_collectes', [EvenementCollecteController::class, 'store'])->name('evenement_collectes.store');

/////routees for sondages entity
Route::resource('/sondage',\App\Http\Controllers\SondageController::class)->names([
    'index' => 'sondage.index',
    'create' => 'sondage.create.form',
    'store' => 'sondage.store',
]);



