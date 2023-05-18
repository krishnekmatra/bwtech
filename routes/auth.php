<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\NewPasswordController as adminNewPaswword;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController as adminReset;

use App\Http\Controllers\Vendor\Auth\NewPasswordController as vendorNewPaswword;
use App\Http\Controllers\Vendor\Auth\PasswordResetLinkController as vendorReset;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::get('admin/forgot-password', [adminReset::class, 'adminforgetPassword'])->name('adminpassword.request');
Route::post('admin/forgot-password', [adminReset::class, 'store'])
                ->name('adminpassword.email');
Route::get('admin/reset-password/{token}', [adminNewPaswword::class, 'create'])
                ->name('adminpassword.reset');
Route::post('admin/reset-password', [adminNewPaswword::class, 'store'])
                ->name('adminpassword.store');


Route::get('vendor/forgot-password', [vendorReset::class, 'adminforgetPassword'])->name('vendorpassword.request');
Route::post('vendor/forgot-password', [vendorReset::class, 'store'])
                ->name('vendorpassword.email');
Route::get('vendor/reset-password/{token}', [vendorNewPaswword::class, 'create'])
                ->name('vendorpassword.reset');

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    

});
Route::post('logout', [App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');