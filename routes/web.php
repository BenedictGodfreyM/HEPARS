<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {

    Route::prefix('combinations')->group(function () {

        Route::get('/register', [App\Http\Controllers\Backend\CombinationController::class, 'register'])->name('combinations.register');
        
        Route::get('/', [App\Http\Controllers\Backend\CombinationController::class, 'index'])->name('combinations');

    });

    Route::prefix('fields')->group(function () {

        Route::prefix('{field_id}')->group(function () {

            Route::prefix('careers')->group(function () {

                Route::get('/register', [App\Http\Controllers\Backend\CareerController::class, 'register'])->name('fields.careers.register');
                
                Route::get('/', [App\Http\Controllers\Backend\CareerController::class, 'index'])->name('fields.careers');

            });

        });

        Route::get('/register', [App\Http\Controllers\Backend\FieldController::class, 'register'])->name('fields.register');
        
        Route::get('/', [App\Http\Controllers\Backend\FieldController::class, 'index'])->name('fields');

    });

    Route::prefix('institutions')->group(function () {

        Route::prefix('{institution_id}')->group(function () {

            Route::prefix('programs')->group(function () {
                    
                Route::get('/register', [App\Http\Controllers\Backend\ProgramController::class, 'register'])->name('institutions.programs.register');

                Route::get('/', [App\Http\Controllers\Backend\ProgramController::class, 'index'])->name('institutions.programs');
            
            });

        });

        Route::get('/register', [App\Http\Controllers\Backend\InstitutionController::class, 'register'])->name('institutions.register');

        Route::get('/', [App\Http\Controllers\Backend\InstitutionController::class, 'index'])->name('institutions');

    });

    Route::prefix('subjects')->group(function () {

        Route::get('/register', [App\Http\Controllers\Backend\SubjectController::class, 'register'])->name('subjects.register');
        
        Route::get('/', [App\Http\Controllers\Backend\SubjectController::class, 'index'])->name('subjects');

    });

    Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

});

Route::get('/admission_portals', [App\Http\Controllers\Frontend\HomeController::class, 'admission_portals'])->name('admission_portals');

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
