<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\MailingController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\ConfigurationsController;
use App\Http\Livewire\Reports\CompaniesContacts;
use App\Http\Livewire\Reports\CompaniesPrograms;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes for all configurations
Route::prefix('configurations')->group(function () {
    Route::get('/', [ConfigurationsController::class, 'index'])->name('configurations.index');

    Route::middleware(['can:edit hosts'])->group(function () {
        Route::patch('/', [ConfigurationsController::class, 'update'])->name('configurations.hosts.update');
    });
    // Prefix for groups controller
    Route::prefix('groups')->group(function () {
        Route::middleware(['can:show groups'])->group(function () {
            Route::get('/', [GroupsController::class, 'index'])->name('configurations.groups.index');
        });
        Route::middleware(['can:create groups'])->group(function () {
            Route::get('/create', [GroupsController::class, 'create'])->name('configurations.groups.create');
            Route::post('/', [GroupsController::class, 'store'])->name('configurations.groups.store');
        });
        Route::middleware(['can:edit groups'])->group(function () {
            Route::get('/{role}/edit', [GroupsController::class, 'edit'])->name('configurations.groups.edit');
            Route::put('/{role}/edit', [GroupsController::class, 'update'])->name('configurations.groups.update');
            Route::delete('/', [GroupsController::class, 'destroy'])->name('configurations.groups.delete');
        });
    });
    Route::prefix('programs')->group(function () {
        Route::middleware(['can:show programs'])->group(function () {
            Route::get('/', [ProgramsController::class, 'index'])->name('configurations.programs.index');
        });
        Route::middleware(['can:create programs'])->group(function () {
            Route::get('/create', [ProgramsController::class, 'create'])->name('configurations.programs.create');
            Route::post('/create', [ProgramsController::class, 'store'])->name('configurations.programs.store');
        });
        Route::middleware(['can:edit programs'])->group(function () {
            Route::get('/{program}/edit', [ProgramsController::class, 'edit'])->name('configurations.programs.edit');
            Route::put('/{program}/edit', [ProgramsController::class, 'update'])->name('configurations.programs.update');
            Route::delete('/', [ProgramsController::class, 'destroy'])->name('configurations.programs.delete');
        });
    });

    Route::prefix('activities')->group(function () {
        Route::middleware(['can:show activities'])->group(function () {
            Route::get('/', [ActivitiesController::class, 'index'])->name('configurations.activities.index');
        });
        Route::middleware(['can:create activities'])->group(function () {
            Route::post('/', [ActivitiesController::class, 'store'])->name('configurations.activities.store');
        });
        Route::middleware(['can:edit activities'])->group(function () {
            Route::patch('/', [ActivitiesController::class, 'update'])->name('configurations.activities.update');
            Route::delete('/', [ActivitiesController::class, 'destroy'])->name('configurations.activities.delete');
        });
    });

    Route::prefix('tags')->group(function () {
        Route::middleware(['can:show tags'])->group(function () {
            Route::get('/', [TagsController::class, 'index'])->name('configurations.tags.index');
        });
        Route::middleware(['can:create tags'])->group(function () {
            Route::post('/', [TagsController::class, 'store'])->name('configurations.tags.store');
        });
        Route::middleware(['can:edit tags'])->group(function () {
            Route::put('/', [TagsController::class, 'update'])->name('configurations.tags.update');
            Route::delete('/', [TagsController::class, 'destroy'])->name('configurations.tags.delete');
        });
    });
});

// Route for companies controller
Route::prefix('companies')->group(function () {
    Route::middleware(['can:show companies'])->group(function () {
        Route::get('/', [CompaniesController::class, 'index'])->name('companies.index');
    });
    Route::middleware(['can:create companies'])->group(function () {
        Route::post('/', [CompaniesController::class, 'store'])->name('companies.store');
    });
    Route::middleware(['can:edit companies'])->group(function () {
        Route::get('/{company}/show', [CompaniesController::class, 'show'])->name('companies.show');
        Route::patch('/{company}/show', [CompaniesController::class, 'update'])->name('companies.update');
        Route::delete('/{company}/show', [CompaniesController::class, 'destroy'])->name('companies.destroy');
        Route::post('/{company}/sync', [CompaniesController::class, 'sync'])->name('companies.sync');
        Route::post('/{company}/add-corporate', [CompaniesController::class, 'corporate'])->name('companies.corporate');
    });
    Route::get('/export', [CompaniesController::class, 'export'])->name('companies.export');
});

// Routes for contacts controller
Route::prefix('contacts')->group(function () {
    Route::middleware(['can:show contacts'])->group(function () {
        Route::get('/', [ContactsController::class, 'index'])->name('contacts.index');
    });
    Route::middleware(['can:create contacts'])->group(function () {
        Route::get('/create', [ContactsController::class, 'create'])->name('contacts.create');
        Route::post('/create', [ContactsController::class, 'store'])->name('contacts.store');
    });
    Route::middleware(['can:edit contacts'])->group(function () {
        Route::get('/{contact}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
        Route::patch('/{contact}/edit', [ContactsController::class, 'update'])->name('contacts.update');
        Route::delete('/{contact}/edit', [ContactsController::class, 'destroy'])->name('contacts.delete');
    });
});

// Routes for tickets controller
Route::prefix('tickets')->group(function () {
    Route::middleware(['can:show tickets'])->group(function () {
        Route::get('/', [TicketsController::class, 'index'])->name('tickets.index');
    });
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
    Route::middleware(['can:show users'])->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
    });
    Route::middleware(['can:create users'])->group(function () {
        Route::get('/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/create', [UsersController::class, 'store'])->name('users.store');
    });
    Route::middleware(['can:edit users'])->group(function () {
        Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/{user}/edit', [UsersController::class, 'update'])->name('users.update');
    });
});

Route::prefix('mailing')->group(function () {
    Route::middleware(['can:show mailings'])->group(function () {
        Route::get('/', [MailingController::class, 'index'])->name('mailing.index');
    });
    Route::middleware(['can:create mailings'])->group(function () {
        Route::get('/create', [MailingController::class, 'create'])->name('mailing.create');
        Route::post('/create', [MailingController::class, 'store'])->name('mailing.store');
    });
});

Route::prefix('reports')->group(function () {
    Route::get('/', function () {
        return view('reports.index');
    })->name('reports.index');

    Route::get('/companies-contacts', CompaniesContacts::class)->name('reports.companies-contacts');
    Route::get('/companies-programs', CompaniesPrograms::class)->name('reports.companies-programs');
});

Route::get('/testSoap', [CompaniesController::class, 'testSoap']);
