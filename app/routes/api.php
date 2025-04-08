<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth.basic.db')->group(function () {
    Route::get('/secure-data', function () {
        return response()->json([
            'message' => 'Zalogowano!',
            'user' => auth()->user()?->only(['id', 'name', 'email']),
        ]);
    });
});
