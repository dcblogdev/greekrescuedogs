<?php

use Modules\Dogs\Models\Dog;

uses(Tests\TestCase::class);

test('can see dogs', function () {
    $this->get(route('dogs.index'))->assertOk();
});

test('can see single dog', function () {
    $dog = Dog::factory()->create();
    $this->get(route('dogs.show', $dog->slug))->assertOk();
});
