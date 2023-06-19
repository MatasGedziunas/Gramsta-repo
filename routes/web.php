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
// Index: This method retrieves and displays a list of items or resources. It is used to present an index or a collection of data.

// Show: The show method retrieves and displays a specific item or resource from the database. It is typically used to view the details of a particular record.

// Create: This method is used to display a form for creating a new item or resource. It collects the user input and saves it to the database.

// Store: The store method is responsible for processing the data submitted through the create form. It takes the input values, performs validation if necessary, and stores the new item or resource in the database.

// Edit: The edit method retrieves and displays a form to edit an existing item or resource. It pre-fills the form fields with the current data.

// Update: This method is responsible for processing the data submitted through the edit form. It updates the existing item or resource with the new values provided by the user.

// Destroy: The destroy method is used to delete an item or resource from the database. It removes the corresponding record permanently.

Route::get('/', [PostController::class, 'index'])->name('main');
// MAIN PAGE
Route::get('/user', [PostController::class, 'feed'])->middleware('auth');
// SHOW LOGIN USER PAGE
Route::get('/user/login', [UserController::class, 'login']);
// LOG IN USER
Route::post('/user/authenticate', [UserController::class, 'authenticate']);
// LOG OUT USER
Route::post('/user/logout', [UserController::class, 'logout']);
// SHOW USER PROFILE
Route::get('/user/profile/{id}', [UserController::class, 'profile']);
// SHOW CREATE USER PAGE
Route::get('/user/create', [UserController::class, 'create']);
// STORE USER DATA
Route::post('/user', [UserController::class, 'store']);
// EDIT USER DATA
Route::put('/user/profile/{id}/edit', [UserController::class, 'edit']);
// FOLLOW A USER
Route::post('/user/{user}/follow/{follow}', [UserController::class, 'follow']);
// FOLLOW A USER
Route::post('/user/{user}/unfollow/{follow}', [UserController::class, 'unfollow']);
// SHOW WHAT USERS A USER IS FOLLOWING
Route::get('/user/profile/{user}/following', [UserController::class, 'following']);
// SHOW WHAT USERS ARE FOLLOWING A USER
Route::get('/user/profile/{user}/followers', [UserController::class, 'followers']);
// POST A POST
Route::post('/post', [PostController::class, 'store']);
// SEARCH
Route::get('/search', [UserController::class, 'search']);
// LIKE A POST
Route::post('/post/{post}/like', [PostController::class, 'like'])->middleware('auth');
// UNLIKE A POST
Route::post('/post/{post}/unlike', [PostController::class, 'unlike'])->middleware('auth');
// COMMENT ON A POST
Route::post('/post/{post}/comment', [PostController::class, 'comment'])->middleware('auth');
