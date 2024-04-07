<?php

use Livewire\Livewire;
use Modules\Dogs\Livewire\Admin\AddDog;
use Modules\Dogs\Livewire\Admin\EditDog;
use Modules\Dogs\Livewire\Admin\Dogs;
use Modules\Dogs\Models\Dog;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->user = $this->authenticate();
});

test('can see dogs', function () {
    $this->get(route('admin.dogs.index'))->assertOk();
});

test('cannot see dogs without admin permission', function () {
    $this->authenticate('user');
    $this->get(route('admin.dogs.index'))->assertStatus(403);
});

test('can see create dog button', function () {
    $this->get(route('admin.dogs.index'))
        ->assertOk()
        ->assertSee('Add Dog');
});

test('can search dogs', function () {
    Livewire::test(Dogs::class)
        ->set('title', 'artisan')
        ->assertSet('title', 'artisan');
});

test('can set property', function () {
    Livewire::test(Dogs::class)
        ->set('sortField', 'title')
        ->assertSet('sortField', 'title');
});

test('can sort dogs', function () {
    Livewire::test(Dogs::class)
        ->call('sortBy', 'title')
        ->assertSet('sortField', 'title')
        ->call('dogs')
        ->assertStatus(200);
});

test('can create dog', function () {
    Livewire::test(AddDog::class)
        ->set('title', 'Top 10 ways to test')
        ->set('description', 'intro text')
        ->set('content', 'main text')
        ->call('store')
        ->assertHasNoErrors();

    $this->assertTrue(Dog::where('title', 'Top 10 ways to test')->exists());
});

test('cannot create dog without name', function () {
    Livewire::test(AddDog::class)
        ->set('title', '')
        ->call('store')
        ->assertHasErrors(['title' => 'required']);
});

test('cannot create dog without description', function () {
    Livewire::test(AddDog::class)
        ->set('description', '')
        ->call('store')
        ->assertHasErrors(['description' => 'required']);
});

test('cannot create post without content', function () {
    Livewire::test(AddDog::class)
        ->set('content', '')
        ->call('store')
        ->assertHasErrors(['content' => 'required']);
});

test('is redirected after post creation', function () {
    Livewire::test(AddDog::class)
        ->set('title', 'Top 10 ways to test')
        ->set('description', 'intro text')
        ->set('content', 'main text')
        ->call('store')
        ->assertRedirect(route('admin.dogs.index'));
});

test('can update dog', function () {
    $dog = Dog::factory()->create();
    Livewire::test(EditDog::class, ['dog' => $dog])
        ->set('title', 'Misc')
        ->set('vaccinated', 'on')
        ->set('microChipped', 'on')
        ->set('sprayed', 'on')
        ->call('update')
        ->assertSessionHasNoErrors();

    $this->assertDatabaseHas(Dog::class, ['title' => 'Misc']);
});
