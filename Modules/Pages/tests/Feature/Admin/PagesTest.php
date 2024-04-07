<?php

use Livewire\Livewire;
use Modules\Pages\Livewire\Admin\AddPage;
use Modules\Pages\Livewire\Admin\EditPage;
use Modules\Pages\Livewire\Admin\Pages;
use Modules\Pages\Models\Page;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->user = $this->authenticate();
});

test('can see pages', function () {
    $this->get(route('admin.pages.index'))->assertOk();
});

test('cannot see pages without admin permission', function () {
    $this->authenticate('user');
    $this->get(route('admin.pages.index'))->assertForbidden();
});

test('can see create page button', function () {
    $this->get(route('admin.pages.index'))
        ->assertOk()
        ->assertSee('Add Page');
});

test('can search pages', function () {
    Livewire::test(Pages::class)
        ->set('title', 'artisan')
        ->assertSet('title', 'artisan');
});

test('can set property', function () {
    Livewire::test(Pages::class)
        ->set('sortField', 'title')
        ->assertSet('sortField', 'title');
});

test('can sort posts', function () {
    Livewire::test(Pages::class)
        ->call('sortBy', 'title')
        ->assertSet('sortField', 'title')
        ->call('pages')
        ->assertStatus(200);
});

test('can create page', function () {
    Livewire::test(AddPage::class)
        ->set('title', 'Top 10 ways to test')
        ->set('content', 'main text')
        ->call('store')
        ->assertHasNoErrors();

    $this->assertTrue(Page::where('title', 'Top 10 ways to test')->exists());
});

test('cannot create post without name', function () {
    Livewire::test(AddPage::class)
        ->set('title', '')
        ->call('store')
        ->assertHasErrors(['title' => 'required']);
});

test('cannot create page without content', function () {
    Livewire::test(AddPage::class)
        ->set('content', '')
        ->call('store')
        ->assertHasErrors(['content' => 'required']);
});

test('is redirected after page creation', function () {
    Livewire::test(AddPage::class)
        ->set('title', 'Top 10 ways to test')
        ->set('content', 'main text')
        ->call('store')
        ->assertRedirect(route('admin.pages.index'));
});

test('can update page', function () {
    $page = Page::factory()->create();
    Livewire::test(EditPage::class, ['page' => $page])
        ->set('title', 'Misc')
        ->call('update')
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas(Page::class, ['title' => 'Misc']);
});
