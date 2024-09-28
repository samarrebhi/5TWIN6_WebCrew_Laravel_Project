<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontControllers\HomeController;
use App\Http\Controllers\BackControllers\HomeControllerBack;
use App\Http\Controllers\FrontControllers\EventController; // Adjust the controller path as needed
use App\Http\Controllers\EvenementCollecteController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CategoryController;


// Home page routes


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index'])->name('homepage');
Route::get('admin', [HomeControllerBack::class, 'index'])->name('admin.home');

Route::get('/events', [EventController::class, 'index'])->name('event.listevent');
Route::get('/events/{id}', [EventController::class, 'show'])->name('event.details');
Route::get('/events', [EventController::class, 'index'])->name('event.listevent');
Route::get('/events/{id}', [EventController::class, 'show'])->name('event.details'); // This line is correct

Route::get('/event/{id}/export-pdf', [EventController::class, 'exportPdf'])->name('event.exportPdf');

// Event Collection Routes
Route::prefix('evenement_collectes')->name('evenement_collecte.')->group(function () {
    Route::get('/', [EvenementCollecteController::class, 'index'])->name('list');
    Route::get('/create', [EvenementCollecteController::class, 'create'])->name('create');
    Route::post('/', [EvenementCollecteController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [EvenementCollecteController::class, 'edit'])->name('edit');
    Route::get('/{id}', [EvenementCollecteController::class, 'show'])->name('evenement_collecte.showDet');

   
   



Route::put('/{id}', [EvenementCollecteController::class, 'update'])->name('update');

    Route::delete('/{id}', [EvenementCollecteController::class, 'destroy'])->name('destroy');
    



    
});
  

Route::get('/centers/{id}', [CenterController::class, 'showDetails'])->name('center.show.details');
Route::get('/center', [CenterController::class, 'index'])->name('center.index');
Route::get('/centers', [CenterController::class, 'showCenters'])->name('centers.index');
Route::resource('/center',CenterController::class);











Route::resource('/sondage', \App\Http\Controllers\BackControllers\SondageController::class)->names([
    'index' => 'sondage.index',
    'create' => 'sondage.create.form',
    'store' => 'sondage.store',
]);


Route::resource('Categories', CategoryController::class);

