<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\API\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);
//     Route::get('/person', [AuthenticationController::class, 'person'])->middleware(['auth:sanctum']);
//     Route::get('/posts', [PostController::class, 'get']);
//     Route::get('/posts/{id}', [PostController::class, 'show']);
//     Route::post('/store', [PostController::class, 'store']);
//     Route::put('/update/{id}', [PostController::class, 'update'])->middleware('isPosts');
//     Route::delete('/delete/{id}', [PostController::class, 'delete'])->middleware('isPosts');

//     Route::post('/comment', [CommentController::class, 'store']);
//     Route::put('/comment/{id}', [CommentController::class, 'update'])->middleware('CommentOwn');
//     Route::delete('/comment/delete/{id}', [CommentController::class, 'delete'])->middleware('CommentOwn');

// });


// Route::post('/login', [AuthenticationController::class, 'login']);


Route::get('/logout', [AuthenticationController::class, 'logout']);
Route::get('/person', [AuthenticationController::class, 'person']);
Route::get('/posts', [PostController::class, 'get']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::post('/posts', [PostController::class, 'store']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'delete']);

Route::post('/comment', [CommentController::class, 'store']);
Route::put('/comment/{id}', [CommentController::class, 'update']);
Route::delete('/comment/delete/{id}', [CommentController::class, 'delete']);


Route::get('/categories', [CategoryController::class, 'category']);

Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);
