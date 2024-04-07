<?php

use Livewire\Livewire;
use Modules\Blog\Livewire\Admin\Categories\AddCategory;
use Modules\Blog\Livewire\Admin\Categories\Categories;
use Modules\Blog\Livewire\Admin\Categories\EditCategory;
use Modules\Blog\Models\Category;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->user = $this->authenticate();
});

test('can see categories', function () {
    $this->get(route('admin.blog.categories.index'))->assertOk();
});

test('cannot see categories without admin permission', function () {
    $this->authenticate('user');
    $this->get(route('admin.blog.categories.index'))->assertForbidden();
});

test('can see create category button', function () {
    $this->get(route('admin.blog.categories.index'))
        ->assertOk()
        ->assertSee('Create Category');
});

test('can see manage posts button', function () {
    $this->get(route('admin.blog.categories.index'))
        ->assertOk()
        ->assertSee('Manage Posts');
});

test('can search categories', function () {
    Livewire::test(Categories::class)
        ->set('title', 'artisan')
        ->assertSet('title', 'artisan');
});

test('can set property', function () {
    Livewire::test(Categories::class)
        ->set('sortField', 'title')
        ->assertSet('sortField', 'title');
});

test('can sort categories', function () {
    Livewire::test(Categories::class)
        ->call('sortBy', 'title')
        ->assertSet('sortField', 'title')
        ->call('categories')
        ->assertStatus(200);
});

test('can create category', function () {
    Livewire::test(AddCategory::class)
        ->set('title', 'General')
        ->call('store')
        ->assertValid();

    $this->assertTrue(Category::where('title', 'General')->exists());
});

test('cannot create category without name', function () {
    Livewire::test(AddCategory::class)
        ->set('title', '')
        ->call('store')
        ->assertHasErrors(['title' => 'required']);
});

test('is redirected after role creation', function () {
    Livewire::test(AddCategory::class)
        ->set('title', 'General')
        ->call('store')
        ->assertRedirect(route('admin.blog.categories.index'));
});

test('can update category', function () {
    $category = Category::factory()->create();
    Livewire::test(EditCategory::class, ['category' => $category])
        ->set('title', 'Misc')
        ->set('parentId', 0)
        ->call('update')
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas(Category::class, ['title' => 'Misc']);
});
