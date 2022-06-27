<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\listing;
use GuzzleHttp\Middleware;

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



// All Listings
Route::get('/', [ListingController::class, 'index'])->name('listing.index');

Route::group(['middleware' => 'auth'], function()
{
    // Show Create Form
    Route::get('/listings/create', [ListingController::class, 'create'])->name('listing.create');

    // Store Listing Data
    Route::post('/listings', [ListingController::class, 'store'])->name('listing.store');

    //Show Edit Form
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listing.edit');

    // Update Listing
    Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listing.update');

    // Delete Listing
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listing.delete');

    //Manage Listings
    Route::get('/listings/manage', [ListingController::class, 'manage'])->name('listing.manage');

    //All Users
    Route::get('/alluser', [UserController::class, 'index'])->name('user.all_user');

    //Log User Out
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});


// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Create New User
Route::post('/users', [UserController::class, 'store']);

//Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

