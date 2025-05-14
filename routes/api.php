<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return response()->json(['status' => 'API is working']);
});

Route::get('/user', [UserController::class, 'loggedUser'])->middleware('auth:sanctum');

Route::post('/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [ApiAuthController::class, 'logout']);

// Route::resources([
//     'posts' => 'PostController',
// ]);

Route::apiResource('users', App\Http\Controllers\UserController::class);

Route::apiResource('compagnies', App\Http\Controllers\CompagnyController::class);

Route::apiResource('categories', App\Http\Controllers\CategoryController::class);

Route::apiResource('quizz', App\Http\Controllers\QuizzController::class);

Route::apiResource('lessons', App\Http\Controllers\LessonController::class);

Route::apiResource('keywords', App\Http\Controllers\KeywordController::class);

Route::apiResource('replies', App\Http\Controllers\ReplyController::class);

Route::apiResource('questions', App\Http\Controllers\QuestionController::class);

Route::apiResource('anecdoctes', App\Http\Controllers\AnecdocteController::class);

Route::apiResource('lesson_readings', App\Http\Controllers\LessonReadingController::class);
