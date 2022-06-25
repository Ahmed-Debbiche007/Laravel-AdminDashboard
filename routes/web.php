<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Auth;
use App\Models\Listing;
use Illuminate\Http\Request;


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


// Routes to the main views
// Route to Home
Route::get('/', function () {
    return view('welcome');
});
// Route to Dashboard
Route::get('/home', function () {
    return redirect ('/Dashboard');
})->middleware('is_admin');
// Routes to registration, login
Auth::routes();
// Route to Dashboard
Route::get('/Dashboard', [HomeController::class,'index'])->name('home')->middleware('is_admin');
// Route to Products
Route::get('/Listings', [HomeController::class,'listings'])->name('Listings')->middleware('is_admin');
// Route to Clients
Route::get('/Clients', [HomeController::class,'clients'])->name('Clients')->middleware('is_admin');


//Routes to user management
// Route to the admin's "add user" form
Route::get('/add', [ProfileController::class, 'addUsers'])->name('add')->middleware('is_admin');
// Route to the admin's "add user" form add request
Route::post('/add', [ProfileController::class, 'store'])->middleware('is_admin');
// Route to the edit user form 
Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile')->middleware('is_admin');
// Route to the "edit user" form update request
Route::put('/profile/{user}', [ProfileController::class, 'update'])->middleware('is_admin');
// Route to the "edit user's password" form update request
Route::put('/profile/password/{user}', [ProfileController::class, 'updatePassword'])->middleware('is_admin');
// These route is only accessible by admin
// Route to the delete request from the "edit user" form 
Route::delete('/profile/{user}', [ProfileController::class, 'destroy'])->middleware('is_admin');
// Route to the delete request from the dashboard
Route::delete('/home/{user}', [ProfileController::class, 'destroy'])->middleware('is_admin');

//Routes to clients management
// Route to the admin's "add client" form
Route::get('/addClient', [ClientController::class, 'addClients'])->name('addClient')->middleware('is_admin');
// Route to the admin's "add client" form add request
Route::post('/addClient', [ClientController::class, 'store'])->middleware('is_admin');
// Route to the edit client form 
Route::get('/client/{client}', [ClientController::class, 'index'])->name('client')->middleware('is_admin');
// Route to the "edit client" form update request
Route::put('/client/{client}', [ClientController::class, 'update'])->middleware('is_admin');
// Route to the "edit client's password" form update request
Route::put('/client/password/{user}', [ClientController::class, 'updatePassword'])->middleware('is_admin');
// These route is only accessible by admin
// Route to the delete request from the "edit client" form 
Route::delete('/client/{client}', [ClientController::class, 'destroy'])->middleware('is_admin');
// Route to the delete request from the dashboard
Route::delete('/home/{client}', [ClientController::class, 'destroy'])->middleware('is_admin');


//Routes to listings management
// Route to the admin's "add client" form
Route::get('/addListing', [ListingController::class, 'addListing'])->middleware('is_admin');
// Route to the admin's "add Listing" form add request
Route::post('/addListing', [ListingController::class, 'store'])->middleware('is_admin');
// Route to the edit Listing form 
Route::get('/Listing/{listing}', [ListingController::class, 'index'])->name('listing')->middleware('is_admin');
Route::get('/Listing/edit/{listing}', [ListingController::class, 'edit'])->name('listing')->middleware('is_admin');
// Route to the "edit listing" form update request
Route::put('/Listing/{listing}', [ListingController::class, 'update'])->middleware('is_admin');
// Route to the delete request from the "edit client" form 
Route::delete('/Listing/{listing}', [ListingController::class, 'destroy'])->middleware('is_admin');
// Route to the delete request from the dashboard
Route::delete('/home/{listing}', [ListingController::class, 'destroy'])->middleware('is_admin');

// Route to Prodcuts
Route::get('/Products', [ListingController::class,'products'])->name('Products');
// Route to Prodcuts
Route::get('/Product/{listing}', [ListingController::class,'index2']);
Route::get('/Cart', [ListingController::class, 'cart']);
Route::get('/add-to-cart/{id}', [ListingController::class, 'addToCart']);
Route::patch('/update-cart', [ListingController::class, 'updateCart'])->name('update.cart');;
Route::delete('/remove-from-cart', [ListingController::class, 'remove'])->name('remove.from.cart');


// Route to a random page
Route::get('/{whereToGo}', function ($whereToGo) {
    return view('whereToGo');
});