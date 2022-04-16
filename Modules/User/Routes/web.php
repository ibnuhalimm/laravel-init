<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;
use Tabuna\Breadcrumbs\Trail;

Route::middleware([
        'auth',
        'superadmin.only'
    ])
    ->group(function() {
        Route::get('user/datatable', [UserController::class, 'datatable'])->name('user.datatable');

        Route::get('user', [UserController::class, 'index'])
            ->name('user.index')
            ->breadcrumbs(fn (Trail $trail) =>
                $trail->push('Home', route('dashboard'))
                    ->push('User', route('user.index'))
            );

        Route::post('user', [UserController::class, 'store'])
            ->name('user.store');

        Route::get('user/create', [UserController::class, 'create'])
            ->name('user.create')
            ->breadcrumbs(fn (Trail $trail) =>
                $trail->push('Home', route('dashboard'))
                    ->push('User', route('user.index'))
                    ->push('Tambah User', route('user.create'))
            );

        Route::get('user/edit/{id}', [UserController::class, 'edit'])
            ->name('user.edit')
            ->breadcrumbs(fn (Trail $trail) =>
                $trail->push('Home', route('dashboard'))
                    ->push('User', route('user.index'))
                    ->push('Edit User', null)
            );

        Route::post('user/update/{user}', [UserController::class, 'update'])
            ->name('user.update');

        Route::post('user/delete/{id}', [UserController::class, 'delete'])
            ->name('user.delete');
    });
