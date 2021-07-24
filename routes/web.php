<?php

use App\Http\Controllers\ActivitiesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\CompaniesController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes for all configurations
Route::prefix('configurations')->group(function () {
    // Prefix for groups controller
    Route::prefix('groups')->group(function () {
        Route::middleware(['can:create groups'])->group(function () {
            Route::get('/', [GroupsController::class, 'index'])->name('configurations.groups.index');
            Route::get('/create', [GroupsController::class, 'create'])->name('configurations.groups.create');
            Route::post('/', [GroupsController::class, 'store'])->name('groups.store');
        });
        Route::middleware(['can:edit groups'])->group(function () {
            Route::get('/{role}/edit', [GroupsController::class, 'edit'])->name('configurations.groups.edit');
            Route::put('/{role}/edit', [GroupsController::class, 'update'])->name('configurations.groups.update');
            Route::get('/{role}/delete', [GroupsController::class, 'destroy'])->name('configurations.groups.delete');
        });
    });
    Route::prefix('programs')->group(function () {
        Route::get('/', [ProgramsController::class, 'index'])->name('configurations.programs.index');
    });

    Route::prefix('activities')->group(function () {
        Route::get('/', [ActivitiesController::class, 'index'])->name('configurations.activities.index');
        Route::post('/', [ActivitiesController::class, 'store'])->name('configurations.activities.store');
        Route::put('/', [ActivitiesController::class, 'update'])->name('configurations.activities.update');
        Route::delete('/', [ActivitiesController::class, 'destroy'])->name('configurations.activities.destroy');
    });

    Route::prefix('tags')->group(function () {
        Route::get('/', [TagsController::class, 'index'])->name('configurations.tags.index');
        Route::post('/', [TagsController::class, 'store'])->name('configurations.tags.store');
        Route::put('/', [TagsController::class, 'update'])->name('configurations.tags.update');
        Route::delete('/', [TagsController::class, 'destroy'])->name('configurations.tags.destroy');
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
