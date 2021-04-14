<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\ConfigurationsController;
use App\Http\Controllers\TicketsController;
use App\Http\Livewire\Configurations\EditTag;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/configurations', [ConfigurationsController::class, 'index'])->name('configurations.index');

Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');

Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactsController::class, 'create'])->name('contacts.create');
Route::post('/contacts/create', [ContactsController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{contact}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
Route::patch('/contacts/{contact}/edit', [ContactsController::class, 'update'])->name('contacts.update');

Route::get('/tickets', [TicketsController::class, 'index'])->name('tickets.index');
Route::get('/tickets/create', [TicketsController::class, 'create'])->name('tickets.create');
Route::post('/tickets/create', [TicketsController::class, 'store'])->name('tickets.store');
