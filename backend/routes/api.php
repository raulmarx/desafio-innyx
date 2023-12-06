<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolesUsersController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});


Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [UserController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('api');
Route::get('/permissions', [PermissionController::class, 'index']);
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/products/category/{id}', [ProductController::class, 'getByCategory'])->middleware('api');
Route::apiResource('/users', UserController::class)->middleware('api');
Route::apiResource('/categories', CategoryController::class)->middleware('api');
Route::apiResource('/products', ProductController::class)->middleware('api');//