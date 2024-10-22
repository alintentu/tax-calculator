<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaxController;

Route::get('/', [TaxController::class, 'showForm']);
Route::post('/calculate', [TaxController::class, 'calculate']);
