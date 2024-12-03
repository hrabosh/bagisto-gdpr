<?php

use Illuminate\Support\Facades\Route;
use Webkul\GDPR\Http\Controllers\Admin\AdminController;
use Webkul\GDPR\Http\Controllers\Admin\SettingsController;

Route::group(['middleware' => ['web']], function () {
    Route::group(['middleware' => ['admin'], 'prefix' => config('app.admin_url')], function () {
        Route::controller(AdminController::class)->prefix('customers/gdpr')->group(function () {
            Route::get('/requests', 'customerDataRequest')->defaults('_config', [
                'view' => 'gdpr::admin.customers.request-list',
            ])->name('admin.gdpr.dataRequest');

            Route::get('/requests/edit/{id}', 'edit')->defaults('_config', [
                'view' => 'gdpr::admin.customers.request-edit',
            ])->name('admin.gdpr.edit');

            Route::post('/update', 'update')->defaults('_config', [
                'redirect' => 'admin.gdpr.dataRequest',
            ])->name('admin.gdpr.update');

            Route::get('/delete/{id}', 'delete')
                ->name('admin.gdpr.delete');
        });
    });
});

Route::group(['middleware' => ['web']], function () {
    Route::group(['middleware' => ['admin'], 'prefix' => config('app.admin_url')], function () {
        Route::controller(SettingsController::class)->prefix('settings/gdpr')->group(function () {
            Route::get('/', 'index')->defaults('_config', [
                'view' => 'gdpr::admin.settings.index',
            ])->name('admin.gdpr.settings.index');

            Route::get('/create', 'create')->defaults('_config', [
                'view' => 'gdpr::admin.settings.edit',
            ])->name('admin.gdpr.settings.create');

            Route::get('/edit/{id}', 'edit')->defaults('_config', [
                'view' => 'gdpr::admin.settings.edit',
            ])->name('admin.gdpr.settings.edit');

            Route::post('/store/{id}', 'store')->defaults('_config', [
                'redirect' => 'admin.gdpr.settings.index',
            ])->name('admin.gdpr.settings.store');

            Route::delete('/delete/{id}', 'destroy')->name('admin.gdpr.settings.delete');
        });
    });
});
