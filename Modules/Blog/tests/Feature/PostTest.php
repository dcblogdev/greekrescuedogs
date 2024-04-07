<?php

use Modules\Blog\Models\Author;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\CategoryPost;
use Modules\Blog\Models\Post;

uses(Tests\TestCase::class);

test('can see posts', function () {
    $this->get(route('blog.index'))->assertOk();
});

test('can see single post', function () {
    $post = Post::factory()->create();
    $this->get(route('blog.show', $post->slug))->assertOk();
});

test('can see categories', function () {
    $this->get(route('blog.categories.index'))->assertOk();
});

test('can see single category', function () {
    $category = Category::factory()->create();
    $post = Post::factory()->create();
    CategoryPost::create(['post_id' => $post->id, 'category_id' => $category->id]);

    $this->get(route('blog.categories.show', $category->slug))->assertOk();
});

test('can see authors', function () {
    $this->get(route('blog.authors.index'))->assertOk();
});

test('can see single author', function () {
    $author = Author::factory()->create();
    Post::factory()->create(['author_id' => $author->id]);

    $this->get(route('blog.authors.show', $author->slug))->assertOk();
});

test('can see feed', function () {
    $this->get(route('blog.feed'))->assertOk();
});

test('can see rss', function () {
    $this->get(route('blog.rss'))->assertOk();
});

test('can see xml', function () {
    $this->get(route('blog.xml'))->assertOk();
});
