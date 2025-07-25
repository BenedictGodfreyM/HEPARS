<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('auth')->group(function () {

    Route::get('/account', [App\Http\Controllers\Backend\UserAccountController::class, 'index'])->name('account.details')->middleware('permission:view.profile');

    
    Route::get('/accreditation', [App\Http\Controllers\Backend\AccreditationController::class, 'index'])->name('accreditation')->middleware('permission:view.accreditations');


    Route::get('/combinations', [App\Http\Controllers\Backend\CombinationController::class, 'index'])->name('combinations')->middleware('permission:view.combinations');


    Route::prefix('fields')->group(function () {

        Route::get('/{field_id}/careers', [App\Http\Controllers\Backend\CareerController::class, 'index'])->name('fields.careers')->middleware('permission:view.careers');

        Route::get('/', [App\Http\Controllers\Backend\FieldController::class, 'index'])->name('fields')->middleware('permission:view.fields');

    });

    Route::prefix('institutions')->group(function () {

        Route::get('/{institution_id}/programs', [App\Http\Controllers\Backend\ProgramController::class, 'index'])->name('institutions.programs')->middleware('permission:view.programs');  

        Route::get('/', [App\Http\Controllers\Backend\InstitutionController::class, 'index'])->name('institutions')->middleware('permission:view.institutions');

    });
    
    Route::get('/permissions', [App\Http\Controllers\Backend\AccessControlController::class, 'permissions'])->name('permissions')->middleware('permission:view.permissions');
    
    Route::prefix('recommendation-requests')->group(function () {

        Route::get('/all', [App\Http\Controllers\Backend\RecommendationController::class, 'all'])->name('all_recommendations')->middleware('permission:view.recommendation.history.of.all.users');
    
        Route::get('/', [App\Http\Controllers\Backend\RecommendationController::class, 'index'])->name('my_recommendations')->middleware('permission:view.recommendation.history');
    
    });

    Route::get('/roles', [App\Http\Controllers\Backend\AccessControlController::class, 'roles'])->name('roles')->middleware('permission:view.roles');
    
    Route::get('/subjects', [App\Http\Controllers\Backend\SubjectController::class, 'index'])->name('subjects')->middleware('permission:view.subjects');
    
    Route::get('/users', [App\Http\Controllers\Backend\AccessControlController::class, 'users'])->name('users')->middleware('permission:view.users');


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

Route::get('/admission-portals', [App\Http\Controllers\Frontend\HomeController::class, 'admission_portals'])->name('admission_portals');

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
