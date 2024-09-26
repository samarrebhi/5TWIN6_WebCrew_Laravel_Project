<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontControllers\HomeController;
use App\Http\Controllers\BackControllers\HomeControllerBack;
use App\Http\Controllers\FrontControllers\EventController; // Adjust the controller path as needed

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
// });Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index'])->name('homepage');
Route::get('admin', [HomeControllerBack::class, 'index'])->name('admin.home');

// Event Collection Routes
Route::get('/evenement_collectes', [EvenementCollecteController::class, 'index'])->name('evenement_collectes.index');
Route::get('/evenement_collectes/create', [EvenementCollecteController::class, 'create'])->name('evenement_collectes.create');
Route::post('/evenement_collectes', [EvenementCollecteController::class, 'store'])->name('evenement_collectes.store');
Route::get('/evenement_collectes/{id}', [EvenementCollecteController::class, 'show'])->name('evenement_collectes.show');
Route::get('/evenement_collectes/{id}/edit', [EvenementCollecteController::class, 'edit'])->name('evenement_collectes.edit');
Route::put('/evenement_collectes/{id}', [EvenementCollecteController::class, 'update'])->name('evenement_collectes.update');
Route::delete('/evenement_collectes/{id}', [EvenementCollecteController::class, 'destroy'])->name('evenement_collectes.destroy');

Route::get('/evenements', [EventController::class, 'index'])->name('evenements.index');
