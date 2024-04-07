<?php

namespace Modules\Blog\Livewire;

use Livewire\Component;
use Modules\Blog\Models\Category as CategoryModel;
use Modules\Blog\Models\Post;

class PostsByCategory extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $posts = Post::with('cats')->whereHas('cats', function ($query) {
            $query->where('slug', '=', $this->slug);
        })->date()->order()->paginate();

        if ($posts->total() == 0) {
            abort(404);
        }

        $cat = CategoryModel::where('slug', $this->slug)->first();
        $pageTitle = "Posts in category: $cat->title";

        return view('blog::livewire.index', compact('posts', 'cat', 'pageTitle'))->layout('layouts.front');
    }
}
