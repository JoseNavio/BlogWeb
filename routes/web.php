<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', [UserController::class,'showCorrectHomePage']) ;

Route::get('/about', [UserController::class,'aboutPage']);

Route::post('/register', [UserController::class,'register']);

Route::post('/login', [UserController::class,'login']);

Route::post('/logout', [UserController::class,'logout']);
