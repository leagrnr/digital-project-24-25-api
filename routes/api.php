<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::resources([
//     'posts' => 'PostController',
// ]);

Route::apiResource('users', App\Http\Controllers\UserController::class);

Route::apiResource('compagnies', App\Http\Controllers\CompagnyController::class);

Route::apiResource('categories', App\Http\Controllers\CategoryController::class);

Route::apiResource('quizzs', App\Http\Controllers\QuizzController::class);

Route::apiResource('lessons', App\Http\Controllers\LessonController::class);

Route::apiResource('keywords', App\Http\Controllers\KeywordController::class);

Route::apiResource('replies', App\Http\Controllers\ReplyController::class);

Route::apiResource('questions', App\Http\Controllers\QuestionController::class);

Route::apiResource('anecdoctes', App\Http\Controllers\AnecdocteController::class);
