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

// Routes for all configurations
Route::prefix('configurations')->group(function () {
    Route::get('/', [ConfigurationsController::class, 'index'])->name('configurations.index');
    // Prefix for groups controller
    Route::prefix('groups')->group(function () {
        Route::middleware(['can:create groups'])->group(function () {
            Route::get('/', [GroupsController::class, 'create'])->name('groups.create');
            Route::post('/', [GroupsController::class, 'store'])->name('groups.store');
        });
        Route::middleware(['can:edit groups'])->group(function () {
            Route::get('/{role}/edit', [GroupsController::class, 'edit'])->name('groups.edit');
            Route::put('/{role}/edit', [GroupsController::class, 'update'])->name('groups.update');
        });
    });
});

// Route for companies controller
Route::get('/companies', [CompaniesController::class, 'index'])
    ->middleware('can:show companies')
    ->name('companies.index');
Route::get('/companies/export', [CompaniesController::class, 'export'])->name('companies.export');

// Routes for contacts controller
Route::prefix('contacts')->group(function () {
    Route::get('/', [ContactsController::class, 'index'])
        ->middleware('can:show contacts')
        ->name('contacts.index');
    Route::middleware(['can:create contacts'])->group(function () {
        Route::get('/create', [ContactsController::class, 'create'])->name('contacts.create');
        Route::post('/create', [ContactsController::class, 'store'])->name('contacts.store');
    });
    Route::middleware(['can:edit contacts'])->group(function () {
        Route::get('/{contact}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
        Route::patch('/{contact}/edit', [ContactsController::class, 'update'])->name('contacts.update');
    });
});

// Routes for tickets controller
Route::prefix('tickets')->group(function () {
    Route::get('/', [TicketsController::class, 'index'])
        ->middleware('can:show tickets')
        ->name('tickets.index');
    Route::middleware(['can:create tickets'])->group(function () {
        Route::get('/create', [TicketsController::class, 'create'])->name('tickets.create');
        Route::post('/create', [TicketsController::class, 'store'])->name('tickets.store');
    });
    Route::middleware(['can:edit tickets'])->group(function () {
        Route::get('/{ticket}/show', [TicketsController::class, 'show'])->name('tickets.show');
        Route::get('/{ticket}/close', [TicketsController::class, 'close'])->name('tickets.close');
        Route::post('/{ticket}/add-comment', [TicketsController::class, 'addComment'])->name('tickets.comment');
        Route::patch('/{ticket}', [TicketsController::class, 'update'])->name('tickets.update');
    });
});

// Routes for users controller
Route::prefix('users')->group(function () {
    Route::get('/', [UsersController::class, 'index'])
        ->middleware('can:show users')
        ->name('users.index');
    Route::middleware(['can:create users'])->group(function () {
        Route::get('/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/create', [UsersController::class, 'store'])->name('users.store');
    });
    Route::middleware(['can:edit users'])->group(function () {
        Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/{user}/edit', [UsersController::class, 'update'])->name('users.update');
    });
});
