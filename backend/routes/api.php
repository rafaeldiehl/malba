<?php


Route::apiResource('avatars', App\Http\Controllers\AvatarController::class);
Route::apiResource('types', App\Http\Controllers\TypeController::class);

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
