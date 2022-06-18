<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Auth;


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
});
// Routes to registration, login
Auth::routes();
// Route to Dashboard
Route::get('/Dashboard', [HomeController::class,'index'])->name('home');
// Route to Products
Route::get('/Listings', [HomeController::class,'listings'])->name('Listings');


//Routes to user management
// Route to the admin's "add user" form
Route::get('/add', [ProfileController::class, 'addUsers'])->name('add');
// Route to the admin's "add user" form add request
Route::post('/add', [ProfileController::class, 'store']);
// Route to the edit user form 
Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile');
// Route to the "edit user" form update request
Route::put('/profile/{user}', [ProfileController::class, 'update']);
// Route to the "edit user's password" form update request
Route::put('/profile/password/{user}', [ProfileController::class, 'updatePassword']);
// These route is only accessible by admin
// Route to the delete request from the "edit user" form 
Route::delete('/profile/{user}', [ProfileController::class, 'destroy']);
// Route to the delete request from the dashboard
Route::delete('/home/{user}', [ProfileController::class, 'destroy']);

// Route to a random page
Route::get('/{whereToGo}', function ($whereToGo) {
    return view('whereToGo');
});