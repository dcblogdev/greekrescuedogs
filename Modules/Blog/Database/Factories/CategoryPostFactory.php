<?php

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\CategoryPost;
use Modules\Blog\Models\Post;

class CategoryPostFactory extends Factory
{
    protected $model = CategoryPost::class;

    public function definition(): array
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create();

        return [
            'category_id' => $category->id,
            'post_id' => $post->id,
        ];
    }
}
