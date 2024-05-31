<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

Route::get('/users', [UserController::class, 'index']);
Route::get('/comments', [CommentController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);