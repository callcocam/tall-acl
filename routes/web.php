<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->prefix('admin')->group(function () {

    Route::get('/minha-conta', \Tall\Acl\Http\Livewire\Admin\Profile\ShowComponent::class)->name('admin.profile.show');
    Route::get('/users', \Tall\Acl\Http\Livewire\Admin\Users\ListComponent::class)->name('admin.users');
    Route::get('/user/cadastrar', \Tall\Acl\Http\Livewire\Admin\Users\CreateComponent::class)->name('admin.users.create');
    Route::get('/user/{model}/editar', \Tall\Acl\Http\Livewire\Admin\Users\EditComponent::class)->name('admin.users.edit');

    Route::get('/roles', \Tall\Acl\Http\Livewire\Admin\Roles\ListComponent::class)->name('admin.roles');  
    Route::get('/role/cadastrar', \Tall\Acl\Http\Livewire\Admin\Roles\CreateComponent::class)->name('admin.roles.create');
    Route::get('/role/{model}/editar', \Tall\Acl\Http\Livewire\Admin\Roles\EditComponent::class)->name('admin.roles.edit');

    Route::get('/permissions', \Tall\Acl\Http\Livewire\Admin\Permissions\ListComponent::class)->name('admin.permissions');
    Route::get('/permission/cadastrar', \Tall\Acl\Http\Livewire\Admin\Permissions\CreateComponent::class)->name('admin.permissions.create');
    Route::get('/permission/{model}/editar', \Tall\Acl\Http\Livewire\Admin\Permissions\EditComponent::class)->name('admin.permissions.edit');
});
