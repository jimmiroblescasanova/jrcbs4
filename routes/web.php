<?php

use App\Http\Controllers\CompaniesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConfigurationsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/configurations', [ConfigurationsController::class, 'index'])->name('configurations.index');

Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');
