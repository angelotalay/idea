<?php

declare(strict_types=1);

use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SessionController;

Route::get('/', fn() => view('welcome'))->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get("/login", [SessionController::class, "create"]);
    Route::post("/login", [SessionController::class, "store"]);
});

Route::delete("/logout", [SessionController::class, "destroy"])->middleware("auth");
