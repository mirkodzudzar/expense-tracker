<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');