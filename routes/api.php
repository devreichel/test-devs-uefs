<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;

Route::apiResource('users', UserController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('tags', TagController::class);
