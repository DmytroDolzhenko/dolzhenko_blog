<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blog\PostController;
use App\Http\Controllers\Api\BlogCategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//posts
Route::get('blog/posts', [PostController::class, 'index']);
Route::post('blog/posts', [PostController::class, 'store']);
Route::get('blog/posts/{id}', [PostController::class, 'show']);
Route::put('blog/posts/{id}', [PostController::class, 'update']);
Route::delete('blog/posts/{id}', [PostController::class, 'destroy']);


//category
Route::get('blog/categories', [BlogCategoryController::class, 'index']);
Route::post('blog/categories', [BlogCategoryController::class, 'store']);
Route::get('blog/categories/{category}', [BlogCategoryController::class, 'show']);
Route::put('blog/categories/{category}', [BlogCategoryController::class, 'update']);
Route::delete('blog/categories/{category}', [BlogCategoryController::class, 'destroy']);
