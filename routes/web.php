<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

//php artisan view:clear to clear the cache

//User related routes
Route::get('/', [UserController::class,'showCorrectHomePage']) ;
Route::get('/about', [UserController::class,'aboutPage']);
Route::post('/register', [UserController::class,'register']);
Route::post('/login', [UserController::class,'login']);
Route::post('/logout', [UserController::class,'logout']);

//Blog post routes
Route::get('/show-form',[PostController::class,'showForm']);
Route::post('/create-post',[PostController::class,'storePost']);