<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\ConfigurationsController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UsersController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/configurations', [ConfigurationsController::class, 'index'])->name('configurations.index');
Route::get('/configurations/groups', [GroupsController::class, 'create'])->name('groups.create');
Route::post('/configurations/groups', [GroupsController::class, 'store'])->name('groups.store');
Route::get('/configurations/groups/{id}/edit', [GroupsController::class, 'edit'])->name('groups.edit');
Route::put('/configurations/groups/{role}/edit', [GroupsController::class, 'update'])->name('groups.update');

Route::get('/companies', [CompaniesController::class, 'index'])
    ->middleware('can:show companies')
    ->name('companies.index');
Route::get('/companies/export', [CompaniesController::class, 'export'])->name('companies.export');

Route::get('/contacts', [ContactsController::class, 'index'])
    ->middleware('can:show contacts')
    ->name('contacts.index');
Route::middleware(['can:create contacts'])->group(function () {
    Route::get('/contacts/create', [ContactsController::class, 'create'])->name('contacts.create');
    Route::post('/contacts/create', [ContactsController::class, 'store'])->name('contacts.store');
});
Route::middleware(['can:edit contacts'])->group(function () {
    Route::get('/contacts/{contact}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
    Route::patch('/contacts/{contact}/edit', [ContactsController::class, 'update'])->name('contacts.update');
});

Route::prefix('tickets')->group(function () {
    Route::get('/', [TicketsController::class, 'index'])->name('tickets.index');
    Route::get('/create', [TicketsController::class, 'create'])->name('tickets.create');
    Route::post('/create', [TicketsController::class, 'store'])->name('tickets.store');
    Route::get('/{ticket}/show', [TicketsController::class, 'show'])->name('tickets.show');
    Route::get('/{ticket}/close', [TicketsController::class, 'close'])->name('tickets.close');
    Route::post('/{ticket}/add-comment', [TicketsController::class, 'addComment'])->name('tickets.comment');
    Route::patch('/{ticket}', [TicketsController::class, 'update'])->name('tickets.update');
});

Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
Route::post('/users/create', [UsersController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}/edit', [UsersController::class, 'update'])->name('users.update');
