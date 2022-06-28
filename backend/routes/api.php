<?php

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

Route::get('users/admin', [App\Http\Controllers\UserController::class, 'admin']);
Route::get('users/hits/asc', [App\Http\Controllers\UserController::class, 'hitsAsc']);
Route::get('users/hits/desc', [App\Http\Controllers\UserController::class, 'hitsDesc']);
Route::get('/users/hits', function() {
    return redirect('/api/users/hits/asc');
});
Route::apiResource('users', App\Http\Controllers\UserController::class);

Route::apiResource('topics', App\Http\Controllers\TopicController::class);
Route::apiResource('subtopics', App\Http\Controllers\SubTopicController::class);
Route::apiResource('avatars', App\Http\Controllers\AvatarController::class);
Route::apiResource('types', App\Http\Controllers\TypeController::class);

