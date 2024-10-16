<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontControllers\HomeController;
use App\Http\Controllers\BackControllers\HomeControllerBack;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BackControllers\BlogController;
use App\Http\Controllers\FrontControllers\BlogControllerFront;
use App\Http\Controllers\FrontControllers\EventController; // Adjust the controller path as needed
use App\Http\Controllers\EvenementCollecteController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BackControllers\ReservationBackController;
use App\Http\Controllers\FrontControllers\ReservationController;
use App\Http\Controllers\FrontControllers\PaymentController;
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
Route::get('/', function () {
    return view('welcome');
});
//Route::get('/', [HomeController::class, 'index'])->name('homepage'); // Set this as the default homepage
////




Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// Login
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);





Route::group(['middleware' => ['auth']], function () {

    Route::get('home', [HomeController::class, 'index'])->name('homepage');
// routes/web.php

Route::post('/event/{id}/participate', [EventController::class, 'participate'])->name('event.participate');


    Route::group(['middleware' => ['auth', 'role:admin']], function () {
        Route::get('/admin/reviews', [ReviewController::class, 'adminIndex'])->name('admin.reviews.index');
        Route::post('/users/block/{id}', [UserController::class, 'block'])->name('users.block');


        // Route to view blocked users
        Route::get('/admin/blocked-users', [UserController::class, 'index'])->name('users.blocked');
        
        // Route to unblock a user
        Route::post('/admin/unblock-user/{id}', [UserController::class, 'unblock'])->name('users.unblock');
        
Route::get('/admin/participants', [EventController::class, 'allParticipants'])->name('admin.participants');


    Route::get('admin', [HomeControllerBack::class, 'index'])->name('admin.home');
    Route::get('admin/listBlog', [BlogController::class, 'index'])->name('admin.listBlog');
    Route::get('admin/createBlog', [BlogController::class, 'create'])->name('admin.createBlog');
    Route::post('admin/store', [BlogController::class, 'store'])->name('admin.store');
    Route::post('/translate-blog', [BlogControllerFront::class, 'translateBlog'])->name('translate.blog');
    Route::get('admin/listBlog/{blog}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('admin/listBlog/{blog}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('admin/listBlog/{blog}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');
    Route::get('admin/listBlog/{blog}/show', [BlogController::class, 'show'])->name('admin.blog.show');
    Route::get('admin/commande', [ReservationBackController::class, 'listCommande'])->name('commandeList');
    Route::patch('/admin/reservations/{id}/confirm', [ReservationBackController::class, 'confirm'])->name('admin.reservations.confirm');
    Route::patch('/admin/reservations/{id}/refuse', [ReservationBackController::class, 'refuse'])->name('admin.reservations.refuse');
    Route::get('/centers', [CenterController::class, 'showCenters'])->name('centers.index');
    Route::get('/centers/{id}', [CenterController::class, 'showDetails'])->name('center.show.details');
    Route::get('/Categoriess', [CategoryController::class, 'showCategories'])->name('Categories.index');
    Route::get('/categoriess/{id}', [CategoryController::class, 'showdetails'])->name('Category.show.details');
    


    
    });

    Route::get('home/blogs', [BlogControllerFront::class, 'indexFront'])->name('Front.Blog.list');
    Route::post('/like-blog/{id}', [BlogControllerFront::class, 'likeBlog'])->middleware('auth');   
    Route::get('home/blog/search', [BlogController::class, 'search'])->name('blog.search');
    Route::get('home/shop/{id}', [ReservationController::class, 'shop'])->name('buy');
    Route::post('home/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('home/cart', [ReservationController::class, 'showCart'])->name('cart');
    Route::delete('/home/reservations/{id}/remove', [ReservationController::class, 'remove'])->name('reservations.remove');
    Route::get('home/reservations/{id}/pay', [ReservationController::class, 'pay'])->name('reservations.pay');
    Route::post('/home/reservations/{id}/process', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::post('/home/reservations/{id}/confirm', [ReservationController::class, 'confirmPayment'])->name('reservations.confirm'); // 




//Route::get('/evenement_collectes/create', [EvenementCollecteController::class, 'create'])->name('evenement_collectes.create');
//Route::get('/evenement_collectes/{id}', [EvenementCollecteController::class, 'show'])->name('evenement_collectes.show');


Route::resource('evenement_collectes', EvenementCollecteController::class);


Route::get('/events', [EventController::class, 'index'])->name('event.listevent');
Route::get('/events/{id}', [EventController::class, 'show'])->name('event.details');
Route::get('/events', [EventController::class, 'index'])->name('event.listevent');
Route::get('/events/{id}', [EventController::class, 'show'])->name('event.details'); // This line is correct

Route::get('/event/{id}/export-pdf', [EventController::class, 'exportPdf'])->name('event.exportPdf');

// Event Collection Routes
Route::group(['middleware' => ['auth', 'role:admin']], function () {

Route::prefix('evenement_collectes')->name('evenement_collecte.')->group(function () {
    Route::get('/', [EvenementCollecteController::class, 'index'])->name('list');
    Route::get('/create', [EvenementCollecteController::class, 'create'])->name('create');
    Route::post('/', [EvenementCollecteController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [EvenementCollecteController::class, 'edit'])->name('edit');
    Route::get('/{id}', [EvenementCollecteController::class, 'show'])->name('evenement_collecte.showDet');
    Route::put('/{id}', [EvenementCollecteController::class, 'update'])->name('update');
    Route::delete('/{id}', [EvenementCollecteController::class, 'destroy'])->name('destroy');
});
});


Route::get('/center', [CenterController::class, 'index'])->name('center.index');
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


Route::resource('Categories', CategoryController::class);
Route::get('/Category', [CategoryController::class, 'index'])->name('Category.index');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Register

// Logout
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

  // Review routes
  Route::get('evenements/{evenementId}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
  Route::get('reviews/create/{evenementId}', [ReviewController::class, 'create'])->name('reviews.create');
  Route::post('/reviews/store/{evenementId}', [ReviewController::class, 'store'])->name('reviews.store');
  Route::get('reviews/{evenementId}/edit/{review}', [ReviewController::class, 'edit'])->name('reviews.edit');
  Route::put('reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
  Route::get('reviews/{evenementId}/edit/{id}', [ReviewController::class, 'edit'])->name('reviews.edit');
  Route::delete('reviews/{evenementId}/{reviewId}', [ReviewController::class, 'destroy'])->name('reviews.destroy');



});
require __DIR__.'/auth.php';