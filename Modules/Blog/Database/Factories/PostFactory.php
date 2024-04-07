<?php

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Blog\Models\Author;
use Modules\Blog\Models\Post;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $author = Author::factory()->create();

        return [
            'title' => $this->faker->name(),
            'slug' => Str::slug($this->faker->name()),
            'author_id' => $author->id,
            'description' => $this->faker->sentence(),
            'content' => $this->faker->sentence(),
            'display_at' => date('Y-m-d H:i:s'),
        ];
    }
}
