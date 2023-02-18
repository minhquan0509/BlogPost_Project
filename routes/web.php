<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\LikeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Auth;

Route::get('search-post', [HomepageController::class, 'search']);
// This routes for view post and categories at homepage
Route::get('/', [HomepageController::class, 'index']);
Route::get('/tutorial/{category_slug}', [HomepageController::class, 'viewCategoryPost']);
Route::get('/tutorial/{category_slug}/{post_slug}', [HomepageController::class, 'viewPost']);

// This routes for administrator to do CRUD with categories,users,posts...
Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    //For Categories
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/add-category', [CategoryController::class, 'create']);
    Route::post('/add-category', [CategoryController::class, 'store']);
    Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit']);
    Route::put('/update-category/{category_id}', [CategoryController::class, 'update']);
    Route::get('/delete-category/{category_id}', [CategoryController::class, 'destroy']);

    //For Posts
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/add-post', [PostController::class, 'create']);
    Route::post('/add-post', [PostController::class, 'store']);
    Route::get('/post/{post_id}', [PostController::class, 'edit']);
    Route::put('/update-post/{post_id}', [PostController::class, 'update']);
    Route::get('/delete-post/{post_id}', [PostController::class, 'destroy']);

    //For Users
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/{user_id}', [UserController::class, 'edit']);
    Route::post('/update-user/{user_id}', [UserController::class, 'update']);
});

//This route for comments to a post
Route::post('comments', [CommentController::class, 'store']);
Route::post('delete-comment', [CommentController::class, 'destroy']);

//This route for handling like and unlike post
Route::post('like-post', [LikeController::class, 'likeHandle']);
Route::post('unlike-post', [LikeController::class, 'unlikeHandle']);

// This route for authentication users (login,sign up,forgot password,....)
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//This route for user questions

Route::prefix('questions')->middleware('auth')->group(function () {
    Route::get('/my-questions', [QuestionController::class, 'index']);
    Route::get('/add-question', [QuestionController::class, 'create']);
    Route::post('/add-question', [QuestionController::class, 'save']);
    Route::get('/edit-question/{question_id}', [QuestionController::class, 'edit']);
    Route::put('/update-question/{question_id}', [QuestionController::class, 'update']);
    Route::get('/delete-question/{question_id}', [QuestionController::class, 'delete']);
});

Route::prefix('questions')->group(function () {
    Route::get('/', [QuestionController::class, 'viewAllQuestion']);
    Route::get('/{category_slug}', [QuestionController::class, 'viewCategoryQuestion']);
    Route::get('/{category_slug}/{question_slug}', [QuestionController::class, 'viewQuestion']);
});

//This route for answer to a post
Route::post('answer', [AnswerController::class, 'store']);
Route::post('delete-answer', [AnswerController::class, 'destroy']);
