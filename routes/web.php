<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
// use App\Models\Listing;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ListingController::class, 'index'])->name('listing.index');


Route::resource('listing', ListingController::class)->except([
   'index'
]);

Route::get('register', [UserController::class, 'create'])->name('register');
Route::get('login', [UserController::class, 'create'])->name('login');

Route::post('users', [UserController::class, 'store'])->name('users.store');