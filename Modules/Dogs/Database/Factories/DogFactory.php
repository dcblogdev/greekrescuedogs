<?php

namespace Modules\Dogs\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Dogs\Models\Dog;

class DogFactory extends Factory
{
    protected $model = Dog::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'slug' => Str::slug($this->faker->name()),
            'description' => $this->faker->sentence(),
            'content' => $this->faker->sentence(),
            'key_features' => $this->faker->sentence(),
            'sex' => $this->faker->sentence(),
            'dob' => $this->faker->date(),
        ];
    }
}
