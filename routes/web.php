<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {

    Route::prefix('career_paths')->group(function () {

        Route::prefix('{career_path_id}')->group(function () {

            Route::get('/edit', [App\Http\Controllers\Backend\CareerPathController::class, 'edit'])->name('career_paths.edit');

        });

        Route::get('/register', [App\Http\Controllers\Backend\CareerPathController::class, 'register'])->name('career_paths.register');
        
        Route::get('/', [App\Http\Controllers\Backend\CareerPathController::class, 'index'])->name('career_paths');

    });

    Route::prefix('combinations')->group(function () {

        Route::prefix('{combination_id}')->group(function () {

            Route::get('/edit', [App\Http\Controllers\Backend\CombinationController::class, 'edit'])->name('combinations.edit');

        });

        Route::get('/register', [App\Http\Controllers\Backend\CombinationController::class, 'register'])->name('combinations.register');
        
        Route::get('/', [App\Http\Controllers\Backend\CombinationController::class, 'index'])->name('combinations');

    });

    Route::prefix('institutions')->group(function () {

        Route::prefix('{institution_id}')->group(function () {

            Route::prefix('programs')->group(function () {

                Route::prefix('{program_id}')->group(function () {

                    Route::get('/edit', [App\Http\Controllers\Backend\ProgramController::class, 'edit'])->name('institutions.programs.edit');
                    
                    Route::get('/show', [App\Http\Controllers\Backend\ProgramController::class, 'show'])->name('institutions.programs.show');
                
                });
                    
                Route::get('/register', [App\Http\Controllers\Backend\ProgramController::class, 'register'])->name('institutions.programs.register');

                Route::get('/', [App\Http\Controllers\Backend\ProgramController::class, 'index'])->name('institutions.programs');
            
            });

            Route::get('/edit', [App\Http\Controllers\Backend\InstitutionController::class, 'edit'])->name('institutions.edit');

        });

        Route::get('/register', [App\Http\Controllers\Backend\InstitutionController::class, 'register'])->name('institutions.register');

        Route::get('/', [App\Http\Controllers\Backend\InstitutionController::class, 'index'])->name('institutions');

    });

    Route::prefix('subjects')->group(function () {

        Route::prefix('{subject_id}')->group(function () {

            Route::get('/edit', [App\Http\Controllers\Backend\SubjectController::class, 'edit'])->name('subjects.edit');

        });

        Route::get('/register', [App\Http\Controllers\Backend\SubjectController::class, 'register'])->name('subjects.register');
        
        Route::get('/', [App\Http\Controllers\Backend\SubjectController::class, 'index'])->name('subjects');

    });

    Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

});

Route::get('/admission_portals', [App\Http\Controllers\Frontend\HomeController::class, 'admission_portals'])->name('admission_portals');

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
