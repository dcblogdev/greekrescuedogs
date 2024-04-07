<?php

use Illuminate\Support\Facades\Route;
use Modules\Dogs\Livewire\Admin\AddDog;
use Modules\Dogs\Livewire\Admin\EditDog;
use Modules\Dogs\Livewire\Admin\Dogs;
use Modules\Dogs\Livewire\Index;
use Modules\Dogs\Livewire\Show;

Route::prefix(config('admintw.prefix').'/dogs')->middleware(['web', 'auth', 'activeUser', 'IpCheckMiddleware'])->group(function () {
    Route::get('/', Dogs::class)->name('admin.dogs.index');
    Route::get('create', AddDog::class)->name('admin.dogs.create');
    Route::get('edit/{dog}', EditDog::class)->name('admin.dogs.edit');
});

Route::get('/', Index::class)->name('dogs.index');
Route::redirect('dog', '/');
Route::get('dog/{slug:slug}', Show::class)->name('dogs.show');
