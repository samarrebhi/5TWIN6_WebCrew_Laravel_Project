<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontControllers\HomeController;
use App\Http\Controllers\BackControllers\HomeControllerBack;

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BackControllers\BlogController;
use App\Http\Controllers\FrontControllers\BlogControllerFront;
use App\Http\Controllers\FrontControllers\EventController; // Adjust the controller path as needed
use App\Http\Controllers\EvenementCollecteController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index'])->name('homepage');

// Register and Login routes
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

// Group routes that require authentication
Route::group(['middleware' => ['auth']], function () {

    // Admin routes
    Route::get('admin', [HomeControllerBack::class, 'index'])->name('admin.home');
    
    // Blog routes for admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('listBlog', [BlogController::class, 'index'])->name('listBlog');
        Route::get('createBlog', [BlogController::class, 'create'])->name('createBlog');
        Route::post('store', [BlogController::class, 'store'])->name('store');
        Route::get('listBlog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('listBlog/{blog}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('listBlog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
        Route::get('listBlog/{blog}/show', [BlogController::class, 'show'])->name('blog.show');
    });

    // Blog routes for frontend
    Route::get('home/blogs', [BlogControllerFront::class, 'indexFront'])->name('Front.Blog.list');
    Route::post('/blog/{id}/like', [BlogControllerFront::class, 'likeBlog']);

    // Event routes
    Route::get('/events', [EventController::class, 'index'])->name('event.listevent');
    Route::get('/events/{id}', [EventController::class, 'show'])->name('event.details');
    Route::get('/event/{id}/export-pdf', [EventController::class, 'exportPdf'])->name('event.exportPdf');

    // Evenement Collecte routes
    Route::resource('evenement_collectes', EvenementCollecteController::class)
        ->except(['show']);
    Route::get('evenement_collectes/{id}', [EvenementCollecteController::class, 'show'])->name('evenement_collectes.show');

    // Center routes
    Route::resource('/centers', CenterController::class)->except(['show']);
    Route::get('/centers/{id}', [CenterController::class, 'showDetails'])->name('centers.show.details');

    // Sondage routes for backend and frontend
    Route::resource('/sondage', \App\Http\Controllers\BackControllers\SondageController::class)
        ->names(['index' => 'sondage.index', 'create' => 'sondage.create.form', 'store' => 'sondage.store']);
    Route::resource('/polls', \App\Http\Controllers\FrontControllers\SondageFrontController::class)
        ->names(['index' => 'sondage.listing', 'show' => 'sondage.details']);

    // Category routes
    Route::resource('Categories', CategoryController::class);
    Route::get('/categoriess/{id}', [CategoryController::class, 'showdetails'])->name('Categories.show.details');
    
    // Review routes
    Route::get('evenements/{evenementId}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('reviews/create/{evenementId}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/store/{evenementId}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('reviews/{evenementId}/edit/{review}', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('reviews/{evenementId}/edit/{id}', [ReviewController::class, 'edit'])->name('reviews.edit');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Auth routes (additional if needed)
require __DIR__.'/auth.php';