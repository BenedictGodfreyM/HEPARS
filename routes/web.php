<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('auth')->group(function () {

    Route::prefix('account')->group(function () {

        Route::get('/', [App\Http\Controllers\Backend\UserAccountController::class, 'index'])->name('account.details');

    });

    Route::prefix('accreditation')->group(function () {

        Route::get('/register', [App\Http\Controllers\Backend\AccreditationController::class, 'register'])->name('accreditation.register');
        
        Route::get('/', [App\Http\Controllers\Backend\AccreditationController::class, 'index'])->name('accreditation');

    });

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

    Route::prefix('verify-email')->group(function () {

        Route::get('/', App\Http\Controllers\Auth\EmailVerificationPromptController::class)->name('verification.notice');

        Route::get('/{id}/{hash}', App\Http\Controllers\Auth\VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    });

    Route::post('email/verification-notification', [App\Http\Controllers\Auth\EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');


    Route::prefix('confirm-password')->group(function () {

        Route::get('/', [App\Http\Controllers\Auth\ConfirmablePasswordController::class, 'show'])->name('password.confirm');

        Route::post('/', [App\Http\Controllers\Auth\ConfirmablePasswordController::class, 'store']);

    });

    Route::put('password', [App\Http\Controllers\Auth\PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

});

Route::middleware('guest')->group(function () {

    Route::get('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');

    Route::post('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

    Route::get('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])->name('password.request');

    Route::post('forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [App\Http\Controllers\Auth\NewPasswordController::class, 'create'])->name('password.reset');

    Route::post('reset-password', [App\Http\Controllers\Auth\NewPasswordController::class, 'store'])->name('password.store');

});

Route::get('/admission_portals', [App\Http\Controllers\Frontend\HomeController::class, 'admission_portals'])->name('admission_portals');

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
