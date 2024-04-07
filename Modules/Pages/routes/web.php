<?php

use Illuminate\Support\Facades\Route;
use Modules\Pages\Livewire\Admin\AddPage;
use Modules\Pages\Livewire\Admin\EditPage;
use Modules\Pages\Livewire\Admin\Pages;
use Modules\Pages\Livewire\Show;

Route::prefix(config('admintw.prefix').'/pages')->middleware(['web', 'auth', 'activeUser', 'IpCheckMiddleware'])->group(function () {
    Route::get('/', Pages::class)->name('admin.pages.index');
    Route::get('create', AddPage::class)->name('admin.pages.create');
    Route::get('edit/{page}', EditPage::class)->name('admin.pages.edit');
});

Route::get('{slug:slug}', Show::class)->name('pages.show');
