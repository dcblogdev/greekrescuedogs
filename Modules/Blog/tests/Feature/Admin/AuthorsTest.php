<?php

use Livewire\Livewire;
use Modules\Blog\Livewire\Admin\Authors\AddAuthor;
use Modules\Blog\Livewire\Admin\Authors\Authors;
use Modules\Blog\Livewire\Admin\Authors\EditAuthor;
use Modules\Blog\Models\Author;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->user = $this->authenticate();
});

test('can see authors', function () {
    $this->get(route('admin.blog.authors.index'))->assertOk();
});

test('cannot see authors without admin permission', function () {
    $this->authenticate('user');
    $this->get(route('admin.blog.authors.index'))->assertForbidden();
});

test('can see create author button', function () {
    $this->get(route('admin.blog.authors.index'))
        ->assertOk()
        ->assertSee('Create Author');
});

test('can see manage posts button', function () {
    $this->get(route('admin.blog.authors.index'))
        ->assertOk()
        ->assertSee('Manage Posts');
});

test('can search authors', function () {
    Livewire::test(Authors::class)
        ->set('name', 'artisan')
        ->assertSet('name', 'artisan');
});

test('can set property', function () {
    Livewire::test(Authors::class)
        ->set('sortField', 'name')
        ->assertSet('sortField', 'name');
});

test('can sort authors', function () {
    Livewire::test(Authors::class)
        ->call('sortBy', 'name')
        ->assertSet('sortField', 'name')
        ->call('authors')
        ->assertStatus(200);
});

test('can create author', function () {
    Livewire::test(AddAuthor::class)
        ->set('name', 'General')
        ->call('store')
        ->assertValid();

    $this->assertTrue(Author::where('name', 'General')->exists());
});

test('cannot create author without name', function () {
    Livewire::test(AddAuthor::class)
        ->set('name', '')
        ->call('store')
        ->assertHasErrors(['name' => 'required']);
});

test('is redirected after role creation', function () {
    Livewire::test(AddAuthor::class)
        ->set('name', 'General')
        ->call('store')
        ->assertRedirect(route('admin.blog.authors.index'));
});

test('can update author', function () {
    $author = Author::factory()->create();
    Livewire::test(EditAuthor::class, ['author' => $author])
        ->set('name', 'Misc')
        ->call('update')
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas(Author::class, ['name' => 'Misc']);
});
