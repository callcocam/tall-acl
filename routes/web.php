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

    Route::get('/users', \Tall\Acl\Http\Livewire\Admin\Users\ListComponent::class)->name(config("acl.routes.users.list"));
    Route::get('/user/create', \Tall\Acl\Http\Livewire\Admin\Users\CreateComponent::class)->name(config("acl.routes.users.create"));
    Route::get('/user/{model}/edit', \Tall\Acl\Http\Livewire\Admin\Users\EditComponent::class)->name(config("acl.routes.users.edit"));

    Route::get('/roles', \Tall\Acl\Http\Livewire\Admin\Roles\ListComponent::class)->name(config("acl.routes.roles.list"));  
    Route::get('/role/create', \Tall\Acl\Http\Livewire\Admin\Roles\CreateComponent::class)->name(config("acl.routes.roles.create"));
    Route::get('/role/{model}/edit', \Tall\Acl\Http\Livewire\Admin\Roles\EditComponent::class)->name(config("acl.routes.roles.edit"));

    Route::get('/permissions', \Tall\Acl\Http\Livewire\Admin\Permissions\ListComponent::class)->name(config("acl.routes.permissions.list"));
    Route::get('/permission/create', \Tall\Acl\Http\Livewire\Admin\Permissions\CreateComponent::class)->name(config("acl.routes.permissions.create"));
    Route::get('/permission/{model}/edit', \Tall\Acl\Http\Livewire\Admin\Permissions\EditComponent::class)->name(config("acl.routes.permissions.edit"));
});
