<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\ConfigurationsController;
use App\Http\Controllers\TicketsController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/configurations', [ConfigurationsController::class, 'index'])->name('configurations.index');

Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');
Route::get('/companies/export', [CompaniesController::class, 'export'])->name('companies.export');

Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactsController::class, 'create'])->name('contacts.create');
Route::post('/contacts/create', [ContactsController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{contact}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
Route::patch('/contacts/{contact}/edit', [ContactsController::class, 'update'])->name('contacts.update');

Route::prefix('tickets')->group(function () {
    Route::get('/', [TicketsController::class, 'index'])->name('tickets.index');
    Route::get('/create', [TicketsController::class, 'create'])->name('tickets.create');
    Route::post('/create', [TicketsController::class, 'store'])->name('tickets.store');
    Route::get('/{ticket}/show', [TicketsController::class, 'show'])->name('tickets.show');
    Route::get('/{ticket}/close', [TicketsController::class, 'close'])->name('tickets.close');
    Route::post('/{ticket}/add-comment', [TicketsController::class, 'addComment'])->name('tickets.comment');
    Route::patch('/{ticket}', [TicketsController::class, 'update'])->name('tickets.update');
});
