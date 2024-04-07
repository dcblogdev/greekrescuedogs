<?php

namespace Modules\Blog\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Blog\Models\Post;

class Posts extends Component
{
    public function render(): View
    {
        $posts = Post::with('cats')->date()->order()->paginate();

        return view('blog::livewire.posts', compact('posts'))->layout('layouts.front');
    }
}
