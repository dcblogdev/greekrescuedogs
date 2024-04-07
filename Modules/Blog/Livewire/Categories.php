<?php

namespace Modules\Blog\Livewire;

use Livewire\Component;
use Modules\Blog\Models\Category;

class Categories extends Component
{
    public function render()
    {
        $categories = Category::order()->get();

        return view('blog::livewire.categories', compact('categories'))->layout('layouts.front');
    }
}
