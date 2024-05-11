<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
Route::get('/', [UserController::class, 'showCorrectHomePage'])->name('home');
Route::post('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Blog post routes
//I change middleware auth file to redirect to home instead and name the route '/' as home
Route::get('/show-form', [PostController::class, 'showForm'])->middleware('auth');
Route::get('/post/{post}', [PostController::class, 'showPost']);
Route::post('/store-post', [PostController::class, 'storePost'])->middleware('auth');
Route::delete('/post/{post}', [PostController::class, 'deletePost'])->middleware('can:delete,post');
Route::get('/post/{post}/edit', [PostController::class, 'showEditForm'])->middleware('can:update,post');
Route::put('/post/{post}', [PostController::class, 'updatePost'])->middleware('can:update,post');

//Profile related routes
//(user:username) So it will look for the username in the User model and not the id 
Route::get('/profile/{user:username}', [ProfileController::class, 'showProfile'])->middleware('auth');

//Admin related routes
Route::get('/admin', function () {
        return "Welcome to the admin page.";
})->middleware('can:visit_admin_pages');