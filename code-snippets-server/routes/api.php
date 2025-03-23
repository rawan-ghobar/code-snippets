<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\SnippetController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "v0.1"], function() {
    // Authenticated Routes
    Route::group(["middleware" => "auth:api"], function() {
        Route::group(["prefix" => "user"], function() {
            Route::post('/snippets/{count}/{page}/{language?}/{tags?}/{id?}', [SnippetController::class, "getSnippets"]);
            Route::post('/addOrUpdatesnipet/{id?}', [SnippetController::class, "addOrUpdateSnippet"]);
            Route::post('/favorites/{count}/{page}', [FavoriteController::class, "getFavorites"]);
            Route::post('/favorites/add', [FavoriteController::class, "addFavorite"]);
            Route::delete('/favorites/remove/{snippetId}', [FavoriteController::class, "removeFavorite"]);
        });
    });

    // Guest Routes
    Route::group(["prefix" => "guest"], function() {
        Route::post('/login', [AuthController::class, "login"]);
        Route::post('/signup', [AuthController::class, "signup"]);
    });
});
