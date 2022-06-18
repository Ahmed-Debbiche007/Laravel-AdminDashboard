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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/Dashboard', [HomeController::class,'index'])->name('home');
Route::get('/Listings', [HomeController::class,'listings'])->name('Listings');
Route::get('/add', [HomeController::class, 'addUsers'])->name('add');

Route::post('/add', [ProfileController::class, 'store']);
Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile/{user}', [ProfileController::class, 'update']);
Route::put('/profile/password/{user}', [ProfileController::class, 'updatePassword']);
Route::delete('/profile/{user}', [ProfileController::class, 'destroy']);
Route::delete('/home/{user}', [ProfileController::class, 'destroy']);


Route::get('/{whereToGo}', function ($whereToGo) {
    return view('whereToGo');
});