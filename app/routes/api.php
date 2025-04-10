<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DocumentController;

Route::middleware('auth.basic.db')->group(function () {
    Route::get('/secure-data', function () {
        return response()->json([
            'message' => 'Zalogowano!',
            'user' => auth()->user()?->only(['id', 'name', 'email']),
        ]);
    });
    Route::post('/patients/{patient}/documents', [DocumentController::class, 'store']);
});
