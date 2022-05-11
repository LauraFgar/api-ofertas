<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JWTAuth;

Route::post('/auth', [App\Http\Controllers\UserController::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::apiResource('ofertas', App\Http\Controllers\OfertasController::class)
    ->only(['index', 'show', 'store']);

    Route::apiResource('usuarios', App\Http\Controllers\UsuariosController::class)
    ->only(['index', 'show', 'store']);

});

